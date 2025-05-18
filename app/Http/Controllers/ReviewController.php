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
    $request->validate([
        'package_id' => 'required|exists:packages,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string',
    ]);

    // تأكد أن المستخدم قد حجز هذه الباقة
    $hasBooking = Booking::where('user_id', auth::id())
                         ->where('package_id', $request->package_id)
                         ->exists();

    if (!$hasBooking) {
        return back()->with('error', 'You must book this package before leaving a review.');
    }

    // تأكد أن المستخدم لم يكتب مراجعة سابقة لنفس الباقة
    $alreadyReviewed = Review::where('user_id', auth::id())
                             ->where('package_id', $request->package_id)
                             ->exists();

    if ($alreadyReviewed) {
        return back()->with('error', 'You have already reviewed this package.');
    }

    Review::create([
        'user_id' => auth::id(),
        'package_id' => $request->package_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return back()->with('success', 'Review submitted successfully!');
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
              ->orderBy('created_at', 'asc') // تغيير من oldest() إلى orderBy
              ->paginate(5);

    return view('reviews.user-index', compact('reviews'));
}

/**
 * Admin review dashboard
 */
public function adminIndex()
{
    $this->authorize('viewAny', Review::class);

    $reviews = Review::with(['user', 'destination'])
                  ->orderBy('created_at', 'asc') // تغيير من oldest() إلى orderBy
                  ->paginate(20);

    return view('reviews.admin-index', compact('reviews'));
}

    /**
     * Admin review dashboard
     */
  
}

