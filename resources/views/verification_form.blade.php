<form action="{{ route('create-plan.createplan') }}" method="POST">
    @csrf
    <label for="planId">planId:</label>
    <input type="number" id="" name="planId">
    <label for="planName">planName:</label>
    <input type="text" id="" name="planName">
    <label for="type">type:</label>
    <input type="text" id="" name="type">
    <label for="amount">amount:</label>
    <input type="number" id="" name="amount">
    <label for="intervalType">intervalType:</label>
    <input type="text" id="" name="intervalType">
    <label for="intervals">intervals:</label>
    <input type="number" id="" name="intervals">
    
    <button type="submit">Send OTP</button>
</form>

