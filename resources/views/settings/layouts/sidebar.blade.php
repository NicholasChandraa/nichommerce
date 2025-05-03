<div id="sidebar" class="bg-white shadow-lg w-[220px] fixed md:static hidden md:block h-full z-50">
    <div class="py-4 min-h-screen">
        <a href="{{ route('user.profile') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200">
            <i class="fas fa-user mr-3"></i>Profile
        </a>
        <a href="{{ route('account.settings.changePasswordForm') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200">
            <i class="fas fa-cog mr-3"></i>Change Password
        </a>
        <a href="{{ route('account.settings.feedbackForm') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200">
            <i class="fas fa-comment-dots mr-3"></i>Send Feedback
        </a>
        <a href="{{ route('user.order_history', ['userId' => Auth::id()]) }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200">
            <i class="fas fa-history mr-3"></i>Order History
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200">
                <i class="fas fa-sign-out-alt mr-3"></i>Log Out
            </button>
        </form>
    </div>
</div>
