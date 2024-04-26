@if(session('success'))
        <script>
            window.onload = function() {
                alert("{{ session('success') }}");
            }
        </script>
    @elseif(session('error'))
    <script>
            window.onload = function() {
                alert("{{ session('error') }}");
            }
        </script>
    @endif
<x-app-layout>
    <div class="container">
        <h1>Profile</h1>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('POST')
            <!-- Display user information for viewing/changing -->
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $user->name }}">

            <label for="phone">Phone:</label>
            <input type="number" name="phone" value="{{ $user->phone }}">

            <label for="division">Division:</label>
            <input type="text" name="division" value="{{ $user->division }}">

            <label for="City">City:</label>
            <input type="text" name="city" value="{{ $user->city }}">

            <label for="address">Address:</label>
            <input type="text" name="address" value="{{ $user->address }}">


            <button type="submit">Update Profile</button>
        </form>

        <form id="changePasswordForm" action="{{ route('profile.updatePassword') }}" method="POST">
            @csrf
            <!-- Option to change password -->
            <label for="current_password">Current Password:</label>
            <input type="password" name="current_password">

            <label for="new_password">New Password:</label>
            <input type="password" name="new_password">

            <label for="new_password_confirmation">Confirm New Password:</label>
            <input type="password" name="new_password_confirmation">

            <button type="button" onclick="confirmChange('changePasswordForm')">Change Password</button>
        </form>
        <form id="changeEmailForm" action="{{ route('profile.updateEmail') }}" method="POST">
            @csrf
            <!-- Option to change email -->

            <label for="new_email">New Email:</label>
            <input type="email" name="new_email" value="{{ $user->email }}">
            
            <label for="current_password">Current Password:</label>
            <input type="password" name="current_password">

            <button type="button" onclick="confirmChange('changeEmailForm')">Change Email</button>
        </form>
        <a href="{{ route('profile.orders') }}">View Order History</a>
    </div>
<script>
function confirmChange(formId) {
    if (confirm("Are you sure you want to proceed?")) {
        document.getElementById(formId).submit();
    }
}
</script>
</x-app-layout>