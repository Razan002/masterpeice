<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Destination;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Package;
use App\Models\Product;

class ReviewController extends Controller
{
    /**
     * Show review creation form
     */
    public function create(Destination $destination)
    {
        // Check if user has an active booking for this destination
        $booking = Booking::where('user_id', Auth::id())
        ->where('destination_id', $destination->id)
        ->where('package_id', null) // Assuming package_id is null for destination bookings
        ->where('status', 'confirmed')
        ->where('booking_date', '<=', Carbon::today())
        ->first();

        if (!$booking) {
            return redirect()
                    ->route('destination.show', $destination->id)
                    ->with('error', 'You must have an active booking for this destination to leave a review');
        }
        

        // Check if user already reviewed this booking
        if (Review::where('booking_id', $booking->id)->exists()) {
            return redirect()
                    ->route('destination.show', $destination->id)
                    ->with('error', 'You have already reviewed this booking');
        }

        return view('reviews.create', [
            'destination' => $destination,
            'package' => null, // Assuming no package for destination reviews
            'product' => null, // Assuming no product for destination reviews
            'booking' => $booking
        ]);
    }

    public function createForPackage(Package $package)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->where('package_id', $package->id)
            ->where('status', 'confirmed')
            ->where('booking_date', '<=', Carbon::today())
            ->first();

        if (!$booking) {
            return redirect()
                    ->route('packages.show', $package->id)
                    ->with('error', 'You must have an active booking for this package to leave a review');
        }

        if (Review::where('booking_id', $booking->id)->exists()) {
            return redirect()
                    ->route('packages.show', $package->id)
                    ->with('error', 'You have already reviewed this booking');
        }

        return view('reviews.create', [
            'destination' => null,
            'product' => null,
            'booking' => $booking
        ]);
    }

    public function createForProduct(Product $product)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->where('status', 'confirmed')
            ->where('booking_date', '<=', Carbon::today())
            ->first();

        if (!$booking) {
            return redirect()
                    ->route('products.show', $product->id)
                    ->with('error', 'You must have purchased this product to leave a review');
        }

        if (Review::where('booking_id', $booking->id)->exists()) {
            return redirect()
                    ->route('products.show', $product->id)
                    ->with('error', 'You have already reviewed this product');
        }

        return view('reviews.create', [
            'destination' => null,
            'package' => null,
            
            'booking' => $booking
        ]);
    }


    /**
     * Store a new review with additional validation
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'destination_id' => 'nullable|exists:destinations,id',
        'package_id' => 'nullable|exists:packages,id',
        'product_id' => 'nullable|exists:products,id',
        'booking_id' => 'required|exists:bookings,id',
        'rating' => 'required|integer|between:1,5',
        'comment' => 'required|string|max:500',
    ]);

    // Verify booking belongs to user and is active
    $booking = Booking::where('id', $validated['booking_id'])
        ->where('user_id', Auth::id())
        ->when(isset($validated['destination_id']), function($query) use ($validated) {
            $query->where('destination_id', $validated['destination_id']);
        })
        ->when(isset($validated['package_id']), function($query) use ($validated) {
            $query->where('package_id', $validated['package_id']);
        })
        ->when(isset($validated['product_id']), function($query) use ($validated) {
            $query->where('product_id', $validated['product_id']);
        })
        ->where('booking_date', '<=', Carbon::today())
        ->first();

    // Rest of the method remains the same...
    if (!$booking) {
        return back()->with('error', 'Invalid or inactive booking');
    }

    if (Review::where('booking_id', $validated['booking_id'])->exists()) {
        return back()->with('error', 'You already reviewed this booking');
    }

    Review::create([
        'user_id' => Auth::id(),
        'destination_id' => $validated['destination_id'] ?? null,
        'package_id' => $validated['package_id'] ?? null,
        'product_id' => $validated['product_id'] ?? null,
        'booking_id' => $validated['booking_id'],
        'rating' => $validated['rating'],
        'comment' => $validated['comment'],
    ]);

    // Redirect to appropriate page based on what was reviewed
    if (isset($validated['destination_id'])) {
        return redirect()
            ->route('destination.show', $validated['destination_id'])
            ->with('success', 'Review submitted successfully!');
    } elseif (isset($validated['package_id'])) {
        return redirect()
            ->route('packages.show', $validated['package_id'])
            ->with('success', 'Review submitted successfully!');
    } elseif (isset($validated['product_id'])) {
        return redirect()
            ->route('products.show', $validated['product_id'])
            ->with('success', 'Review submitted successfully!');
    }

    return back()->with('error', 'Invalid review submission');
}

    public function edit(Review $review)
    {
        $this->authorize('update', $review);
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update a review
     */
    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);

        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500',
        ]);

        $review->update($validated);

        return redirect()
                ->route('destination.show', $review->destination_id)
                ->with('success', 'Review updated!');
    }

    /**
     * Delete a review
     */
    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        
        $destinationId = $review->destination_id;
        $review->delete();

        return redirect()
                ->route('destination.show', $destinationId)
                ->with('success', 'Review deleted');
    }

    /**
     * Show user's reviews
     */
    public function userReviews()
    {
        $reviews = Review::where('user_id', Auth::id())
                  ->with('destination')
                  ->latest()
                  ->paginate(10);

        return view('reviews.user-index', compact('reviews'));
    }

    /**
     * Admin review dashboard
     */
    public function adminIndex()
    {
        $this->authorize('viewAny', Review::class);

        $reviews = Review::with(['user', 'destination'])
                      ->latest()
                      ->paginate(20);

        return view('reviews.admin-index', compact('reviews'));
    }
}

