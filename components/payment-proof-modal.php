<section class="mymodal" id="submit-payment-proof-modal">
    <div class="modal-content">
        <form action="./" method="POST" enctype="multipart/form-data">
            <h4 class="h4">Upload Payment Receipt</h4>
            <input type="file" name="request-activation" id="payment-receipt-input" class="opacity-0" accept="image/*" required>
            <div id="receipt-preview">
            </div>            
            <button id="receipt-submit-btn">Submit</button>
        </form>
    </div>
</section>