<h4>Payment Section</h4>
<div style="height: 150px; background: #f8d0d0; margin-bottom: 20px;">
    <!-- [Dummy payment content] -->
</div>

<div class="text-end">
    <!-- Pay Now button -->
    <a href="#" class="btn btn-success me-2">Pay Now</a>

    <!-- Pay Later button -->
    <button id="payLaterBtn" class="btn btn-secondary">Pay Later</button>
</div>

<script>

    $(document).ready(function () {
        $('#payLaterBtn').on('click', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/cart/pay-later', // your backend route
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    // add other data if needed
                },
                success: function (response) {
                    console.log(response, 'res');
                    
                    // Assuming response contains the quote ID like: { quote_id: 584586 }
                    window.location.href = '/thank-you?quote_id=' + response.quote_id;
                },

                error: function (xhr) {
                    Swal.fire('Error', xhr.response.error ?? 'Something went wrong', 'error');
                    console.error(xhr.responseText);
                }
            });
        });
    });


</script>