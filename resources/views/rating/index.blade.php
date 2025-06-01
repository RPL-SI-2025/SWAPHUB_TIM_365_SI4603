@extends('layouts.app')

@section('content')
<style>
.feedback-section { 
    padding: 60px 100px; 
    background: #F5F7FA; 
    text-align: center; 
}

.stars { 
    display: flex; 
    justify-content: center; 
    gap: 30px; 
    margin-bottom: 20px; 
    flex-direction: row-reverse; 
}

.stars input { 
    display: none; 
}

.stars label { 
    font-size: 60px; 
    color: #CFCFCF; 
    transition: color 0.3s; 
    cursor: pointer;
}

.stars input:checked ~ label, 
.stars label:hover, 
.stars label:hover ~ label { 
    color: #FFD700; 
}

.feedback-form { 
    display: flex; 
    flex-direction: column; 
    gap: 20px; 
    width: 50%; 
    margin: 0 auto; 
}

.feedback-form input, 
.feedback-form textarea { 
    width: 100%; 
    padding: 12px; 
    border: 1px solid #CFCFCF; 
    border-radius: 5px; 
    font-family: 'Inter'; 
    font-size: 14px; 
    color: #263238; 
}

.feedback-form input::placeholder, 
.feedback-form textarea::placeholder { 
    color: #717171; 
    opacity: 0.7; 
}

.feedback-form textarea { 
    height: 150px; 
    resize: none; 
}

.submit-btn {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: transform 0.2s;
}

.submit-btn:hover {
    transform: translateY(-2px);
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.edit-delete-buttons {
    margin-top: 20px;
    display: flex;
    gap: 10px;
    justify-content: center;
}

.btn-edit, .btn-delete {
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.btn-edit {
    background-color: #28a745;
    color: white;
}

.btn-delete {
    background-color: #dc3545;
    color: white;
}

.existing-rating {
    background: white;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
</style>

<div class="feedback-section">
    <h2 class="text-3xl font-bold text-center text-tertiary text-shadow-lg mb-8">
    Give Us <span class="text-primary">Feedback</span> for <span class="text-primary">Improvement</span>
    </h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @auth
        @if($userRating)
            <!-- Display existing rating -->
            <div class="existing-rating">
                <h3>Your Current Rating</h3>
                <div class="stars">
                    @for($i = 5; $i >= 1; $i--)
                        <span style="color: {{ $i <= $userRating->rating ? '#FFD700' : '#CFCFCF' }}; font-size: 30px;">★</span>
                    @endfor
                </div>
                <p><strong>Your Review:</strong> {{ $userRating->review }}</p>
                <p><small>Submitted on: {{ $userRating->created_at->format('M d, Y') }}</small></p>
                
                <div class="edit-delete-buttons">
                    <button class="btn-edit" onclick="toggleEditForm()">Edit Rating</button>
                    <form method="POST" action="{{ route('rating.destroy', $userRating->id_rating_website) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete your rating?')">Delete Rating</button>
                    </form>
                </div>
            </div>

            <!-- Edit form (initially hidden) -->
            <div id="editForm" style="display: none;">
                <h3>Edit Your Rating</h3>
                <form method="POST" action="{{ route('rating.update', $userRating->id_rating_website) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="stars">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" name="rating" id="edit_star{{ $i }}" value="{{ $i }}" 
                                   {{ $userRating->rating == $i ? 'checked' : '' }}>
                            <label for="edit_star{{ $i }}">★</label>
                        @endfor
                    </div>
                    
                    <div class="feedback-form">
                        <textarea name="review" placeholder="Update your message" required>{{ $userRating->review }}</textarea>
                        <button type="submit" class="submit-btn">Update Rating</button>
                        <button type="button" class="submit-btn" onclick="toggleEditForm()" style="background: #6c757d;">Cancel</button>
                    </div>
                </form>
            </div>
        @else
            <!-- New rating form -->
            <form method="POST" action="{{ route('rating.store') }}">
                @csrf
                
                <div class="stars">
                    <input type="radio" name="rating" id="star5" value="5" required>
                    <label for="star5">★</label>
                    <input type="radio" name="rating" id="star4" value="4" required>
                    <label for="star4">★</label>
                    <input type="radio" name="rating" id="star3" value="3" required>
                    <label for="star3">★</label>
                    <input type="radio" name="rating" id="star2" value="2" required>
                    <label for="star2">★</label>
                    <input type="radio" name="rating" id="star1" value="1" required>
                    <label for="star1">★</label>
                </div>
                
                <div class="feedback-form">
                    <textarea name="review" placeholder="Message" required></textarea>
                    <button type="submit" class="submit-btn">Send Feedback</button>
                </div>
            </form>
        @endif
    @else
        <div class="alert alert-error">
            <p>Please <a href="{{ route('login') }}">login</a> to submit a rating.</p>
        </div>
    @endauth
</div>

<script>
function toggleEditForm() {
    const editForm = document.getElementById('editForm');
    if (editForm.style.display === 'none') {
        editForm.style.display = 'block';
    } else {
        editForm.style.display = 'none';
    }
}

// Add interactive star rating
document.addEventListener('DOMContentLoaded', function() {
    const starContainers = document.querySelectorAll('.stars');
    
    starContainers.forEach(container => {
        const stars = container.querySelectorAll('label');
        const inputs = container.querySelectorAll('input');
        
        stars.forEach((star, index) => {
            star.addEventListener('mouseover', function() {
                highlightStars(stars, stars.length - index);
            });
            
            star.addEventListener('mouseout', function() {
                resetStars(stars, inputs);
            });
            
            star.addEventListener('click', function() {
                const input = container.querySelector(`input[value="${stars.length - index}"]`);
                if (input) {
                    input.checked = true;
                    highlightStars(stars, stars.length - index);
                }
            });
        });
    });
    
    function highlightStars(stars, count) {
        stars.forEach((star, index) => {
            if (index >= stars.length - count) {
                star.style.color = '#FFD700';
            } else {
                star.style.color = '#CFCFCF';
            }
        });
    }
    
    function resetStars(stars, inputs) {
        const checkedInput = Array.from(inputs).find(input => input.checked);
        if (checkedInput) {
            highlightStars(stars, parseInt(checkedInput.value));
        } else {
            stars.forEach(star => {
                star.style.color = '#CFCFCF';
            });
        }
    }
});
</script>

@endsection