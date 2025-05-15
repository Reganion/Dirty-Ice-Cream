<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome to Dirty Ice Cream Shop</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #fff;
      background: url('{{ asset('storage/images/dirty-icecream.jpeg') }}') no-repeat center center fixed;
      background-size: cover;
      text-align: center;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: rgba(0, 0, 0, 0.7);
      padding: 15px 40px;
      width: 100%;
      position: fixed;
      top: 0;
      z-index: 1000;
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      flex-wrap: wrap;
    }

    .brand {
      color: #fff;
      font-size: 1.8em;
      font-weight: bold;
      text-decoration: none;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 25px;
    }

    .nav-item {
      position: relative;
      transition: transform 0.2s;
    }

    .nav-item:hover {
      transform: translateY(-3px);
    }

    .nav-icon {
      font-size: 1.6em;
      color: #fff;
      transition: color 0.3s ease;
    }

    .nav-icon:hover {
      color: #ffd166;
    }

    .nav-item span {
      position: absolute;
      bottom: -30px;
      left: 50%;
      transform: translateX(-50%);
      background-color: rgba(0, 0, 0, 0.8);
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 0.8em;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    .nav-item:hover span {
      opacity: 1;
      visibility: visible;
    }

    .feedback-form {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 30px;
      margin-top: 120px;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
      border-radius: 15px;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.5);
    }

    .feedback-form h2 {
      color: #fff;
      margin-bottom: 25px;
      font-size: 2em;
      text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .form-group {
      text-align: left;
      margin-bottom: 25px;
    }

    .form-group label {
      color: #fff;
      font-weight: bold;
      display: block;
      margin-bottom: 8px;
      font-size: 1.1em;
    }

    .feedback-form textarea,
    .feedback-form select {
      width: 100%;
      padding: 12px 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1rem;
      resize: none;
      background-color: rgba(255,255,255,0.9);
      transition: all 0.3s ease;
    }

    .feedback-form textarea:focus,
    .feedback-form select:focus {
      outline: none;
      border-color: #ffd166;
      box-shadow: 0 0 0 2px rgba(255, 209, 102, 0.3);
    }

    .feedback-form button {
      background-color: #ffd166;
      color: #000;
      padding: 12px 30px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 1.1rem;
      font-weight: 600;
      transition: all 0.3s ease;
      width: 100%;
      margin-top: 15px;
    }

    .feedback-form button:hover {
      background-color: #ffc233;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    /* Star Rating Styles */
    .rating-container {
      display: flex;
      justify-content: center;
      margin: 20px 0;
    }

    .rating-input {
      display: none;
    }

    .rating-star {
      font-size: 2.5rem;
      color: #ddd;
      cursor: pointer;
      transition: color 0.2s, transform 0.2s;
      margin: 0 5px;
    }

    .rating-star:hover,
    .rating-star:hover ~ .rating-star,
    .rating-input:checked ~ .rating-star {
      color: #ffd166;
    }

    .rating-input:checked + .rating-star {
      transform: scale(1.1);
    }

    /* Media Upload Styles */
    .media-upload-container {
      margin: 25px 0;
    }

    .media-upload-label {
      display: block;
      padding: 15px;
      border: 2px dashed rgba(255,255,255,0.5);
      border-radius: 10px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
      background-color: rgba(255,255,255,0.1);
    }

    .media-upload-label:hover {
      border-color: #ffd166;
      background-color: rgba(255, 209, 102, 0.1);
    }

    .media-upload-icon {
      font-size: 2.5rem;
      color: #ffd166;
      margin-bottom: 10px;
    }

    .media-upload-text {
      color: #fff;
      font-size: 1.1rem;
    }

    .media-upload-subtext {
      color: rgba(255,255,255,0.7);
      font-size: 0.9rem;
      margin-top: 5px;
    }

    .media-preview-container {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 20px;
    }

    .media-preview {
      position: relative;
      width: 120px;
      height: 120px;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .media-preview img,
    .media-preview video {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .remove-media {
      position: absolute;
      top: 5px;
      right: 5px;
      background-color: rgba(0,0,0,0.7);
      color: white;
      border: none;
      border-radius: 50%;
      width: 25px;
      height: 25px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 12px;
    }

    /* Modern alert styles */
    .alert {
      padding: 15px;
      color: white;
      margin-bottom: 20px;
      border-radius: 10px;
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      width: 50%;
      text-align: center;
      z-index: 9999;
      font-size: 16px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      animation: slideIn 0.5s ease-in-out;
    }

    .alert-success {
      background-color: #28a745;
    }

    .alert-error {
      background-color: #dc3545;
    }

    @keyframes slideIn {
      from { top: -100px; opacity: 0; }
      to { top: 20px; opacity: 1; }
    }

    @media (max-width: 768px) {
      .alert {
        width: 90%;
        font-size: 14px;
        padding: 12px;
      }

      .navbar {
        flex-direction: column;
        padding: 10px 0;
      }

      .brand {
        margin-bottom: 10px;
        font-size: 1.5em;
      }

      .nav-links {
        flex-direction: row;
        justify-content: space-around;
        width: 100%;
        padding: 10px 0;
        background-color: rgba(0, 0, 0, 0.9);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 999;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
      }

      .nav-item {
        flex: 1;
        text-align: center;
      }

      .nav-item span {
        display: none;
      }

      .feedback-form {
        margin-top: 140px;
        padding: 20px;
        width: 90%;
      }

      .feedback-form h2 {
        font-size: 1.6em;
      }

      .feedback-form textarea,
      .feedback-form select {
        font-size: 0.95rem;
        padding: 10px;
        width: 100%;
        box-sizing: border-box;
      }

      .rating-star {
        font-size: 2rem;
      }

      .media-preview {
        width: 80px;
        height: 80px;
      }
    }
    .existing-media-preview {
    margin-top: 15px;
    text-align: center;
}
.existing-media {
    max-width: 100%;
    max-height: 200px;
    border-radius: 8px;
}
.current-media-text {
    color: #666;
    font-size: 0.8rem;
    margin-top: 5px;
}
  </style>
</head>
<body>
    <!-- Success and error alerts -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-error">
        {{ $errors->first() }}
    </div>
    @endif
    <nav class="navbar">
      <a href="/customer/dashboard" class="brand"><img src="{{ asset('storage/images/logo.png') }}" alt="Logo" style="height: 40px; width: 40px; border-radius: 50%; vertical-align: middle; margin-right: 10px;">
        Dirty Ice Cream</a>
      <div class="nav-links">
        <div class="nav-item">
          <a href="/customer/dashboard" class="nav-icon"><i class="fas fa-home"></i></a>
          <span>Home</span>
        </div>
        <div class="nav-item">
          <a href="/customer/book" class="nav-icon"><i class="fas fa-users"></i></a>
          <span>Book now</span>
        </div>
        <div class="nav-item">
          <a href="/customer/feedback" class="nav-icon"><i class="fas fa-comments"></i></a>
          <span>Send Feedback</span>
        </div>
        <div class="nav-item">
          <a href="/customer/flavor" class="nav-icon"><i class="fas fa-ice-cream"></i></a>
          <span>Flavors</span>
        </div>
        <div class="nav-item">
          <a href="/customer/advancepaymet/{booking_id}" class="nav-icon"><i class="fas fa-credit-card"></i></a>
          <span>Advance Payment</span>
        </div>
        <div class="nav-item">
          <a href="/customer/trackorder" class="nav-icon"><i class="fas fa-truck"></i></a>
          <span>Track Order</span>
        </div>
        <form action="{{ route('customer.logout') }}" method="POST">
          @csrf
          <button type="submit" style="background: none; border: none; color: inherit; font: inherit; cursor: pointer;">
              <div class="nav-item">
                  <a href="#" class="nav-icon"><i class="fas fa-sign-out-alt"></i></a>
                  <span>Logout</span>
              </div>
          </button>
      </form>
    </div>
  </nav>
  

  <!-- Feedback Form -->
  <div class="feedback-form">
    <h2>Share Your Feedback</h2>
    <form action="{{ route('feedback.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
  
      <div class="form-group">
        <label for="flavor_name">Select Flavor</label>
        <select name="flavor_name" id="flavor_name" required>
            <option value="">-- Choose a flavor --</option>
            @foreach ($flavors as $flavor)
                <option value="{{ $flavor }}" {{ old('flavor_name') == $flavor ? 'selected' : '' }}>
                    {{ $flavor }}
                </option>
            @endforeach
        </select>
        @error('flavor_name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      
      <!-- Star Rating System -->
      <div class="form-group">
        <label>Your Rating</label>
        <div class="rating-container">
          <input type="radio" id="star5" name="rating" value="5" class="rating-input" {{ old('rating') == '5' ? 'checked' : '' }}>
          <label for="star5" class="rating-star"><i class="fas fa-star"></i></label>
          
          <input type="radio" id="star4" name="rating" value="4" class="rating-input" {{ old('rating') == '4' ? 'checked' : '' }}>
          <label for="star4" class="rating-star"><i class="fas fa-star"></i></label>
          
          <input type="radio" id="star3" name="rating" value="3" class="rating-input" {{ old('rating') == '3' ? 'checked' : '' }}>
          <label for="star3" class="rating-star"><i class="fas fa-star"></i></label>
          
          <input type="radio" id="star2" name="rating" value="2" class="rating-input" {{ old('rating') == '2' ? 'checked' : '' }}>
          <label for="star2" class="rating-star"><i class="fas fa-star"></i></label>
          
          <input type="radio" id="star1" name="rating" value="1" class="rating-input" {{ old('rating') == '1' ? 'checked' : '' }}>
          <label for="star1" class="rating-star"><i class="fas fa-star"></i></label>
        </div>
        @error('rating')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
  
      <div class="form-group">
          <label for="comments">Your Experience</label>
          <textarea name="comments" id="comments" rows="4" placeholder="Tell us about your experience with this flavor...">{{ old('comments') }}</textarea>
          @error('comments')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
      </div>

      <!-- Media Upload Section -->
<div class="form-group media-upload-container">
    <label class="media-upload-label" for="media_upload">
        <div class="media-upload-icon">
            <i class="fas fa-camera"></i>
        </div>
        <div class="media-upload-text">Add Photo or Video</div>
        <div class="media-upload-subtext">Click to upload (JPEG, PNG, MP4)</div>
        <input type="file" id="media_upload" name="media[]" accept="image/*,video/*" style="display: none;">
    </label>
    
    <!-- This is for PREVIEWING NEW UPLOADS (JavaScript will add previews here) -->
    <div class="media-preview-container" id="media_preview">
        <!-- JavaScript will insert upload previews here -->
    </div>

    <!-- This is for DISPLAYING EXISTING MEDIA (if editing feedback) -->
    @if(isset($feedback) && ($feedback->media_type == 'image' || $feedback->media_type == 'video'))
        <div class="existing-media-preview">
            @if($feedback->media_type == 'image')
                <img src="{{ asset($feedback->image_path) }}" alt="Current Feedback Image" class="existing-media">
            @elseif($feedback->media_type == 'video')
                <video controls class="existing-media">
                    <source src="{{ asset($feedback->video_path) }}" type="video/mp4">
                </video>
            @endif
            <p class="current-media-text">Current media</p>
        </div>
    @endif

    @error('media')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    @error('media.*')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
  
      <button type="submit">
          <i class="fas fa-paper-plane"></i> Submit Feedback
      </button>
    </form>
  </div>

  <script>
    // Display alert if session success or error exists
    window.onload = function() {
      var alert = document.querySelector('.alert');
      if (alert) {
        alert.style.display = 'block';
        setTimeout(function() {
          alert.style.display = 'none';
        }, 5000);
      }

      // Initialize media preview functionality
      setupMediaUpload();
    };

    function setupMediaUpload() {
      const mediaUpload = document.getElementById('media_upload');
      const mediaPreview = document.getElementById('media_preview');
      
      mediaUpload.addEventListener('change', function(event) {
        mediaPreview.innerHTML = ''; // Clear previous previews
        
        const files = event.target.files;
        if (files.length > 5) {
          alert('You can upload a maximum of 5 files');
          return;
        }
        
        for (let i = 0; i < files.length; i++) {
          const file = files[i];
          const fileType = file.type.split('/')[0]; // 'image' or 'video'
          
          if (!file.type.match('image.*') && !file.type.match('video.*')) {
            continue; // Skip non-image/video files
          }
          
          const reader = new FileReader();
          
          reader.onload = function(e) {
            const previewDiv = document.createElement('div');
            previewDiv.className = 'media-preview';
            
            if (fileType === 'image') {
              previewDiv.innerHTML = `
                <img src="${e.target.result}" alt="Preview">
                <button type="button" class="remove-media" onclick="removeMediaPreview(this)">×</button>
              `;
            } else {
              previewDiv.innerHTML = `
                <video controls>
                  <source src="${e.target.result}" type="${file.type}">
                </video>
                <button type="button" class="remove-media" onclick="removeMediaPreview(this)">×</button>
              `;
            }
            
            mediaPreview.appendChild(previewDiv);
          }
          
          reader.readAsDataURL(file);
        }
      });
    }

    function removeMediaPreview(button) {
      const previewContainer = document.getElementById('media_preview');
      const previewDiv = button.parentElement;
      previewContainer.removeChild(previewDiv);
      
      // Update the file input to remove the corresponding file
      const fileInput = document.getElementById('media_upload');
      const files = Array.from(fileInput.files);
      const index = Array.from(previewContainer.children).indexOf(previewDiv);
      
      if (index !== -1) {
        files.splice(index, 1);
        
        // Create a new DataTransfer object to update the files
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
      }
    }
  </script>
</body>
</html>