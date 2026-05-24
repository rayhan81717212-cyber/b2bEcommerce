@extends('admin.layout.master')
@section('title', 'Send Email')

@section('content')

<div class="mx-md-4">
    <div class="container-fluid p-md-5 flex-grow-1 container-p-y">

        <div class="card shadow-sm">
            <div class="card-body">

                <h4 class="mb-4">
                    <i class="bx bx-envelope"></i> Send Email
                </h4>

                <form id="emailForm" action="{{ route('send.email') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">To</label>
                        <input type="email" name="to" class="form-control" placeholder="Enter email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">CC</label>
                        <input type="email" name="cc" class="form-control" placeholder="Add CC (optional)">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Email subject" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea id="body" name="message" class="form-control" rows="6"></textarea>
                        <small class="text-muted" id="char-count">0 characters</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Attachment</label>
                        <input type="file" name="attachment" class="form-control" id="fileInput">
                        <div id="filePreview" class="mt-2"></div>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="sendEmail()">
                        <i class="bx bx-send"></i> Send
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection


@section('scripts')

<script>

    function updateCount() {
        let text = document.getElementById('body').value;
        document.getElementById('char-count').innerText = text.length + " characters";
    }

    function sendEmail() {

        Swal.fire({
            title: 'Send Email?',
            text: "Do you want to send this email?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Send',
            cancelButtonText: 'Cancel'
        }).then((result) => {

            if (result.isConfirmed) {

                document.getElementById('emailForm').submit();

                Swal.fire({
                    icon: 'success',
                    title: 'Sent!',
                    text: 'Email sent successfully!',
                    timer: 1500,
                    showConfirmButton: false
                });

            }

        });

    }

    // FILE PREVIEW (FIXED)
    document.getElementById('fileInput').addEventListener('change', function(e) {

        let file = e.target.files[0];
        let preview = document.getElementById('filePreview');

        if(file){
            preview.innerHTML = `
                <div style="
                    padding:10px;
                    border:1px solid #ddd;
                    border-radius:6px;
                    background:#f8f9fa;
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                ">
                    📎 <strong>${file.name}</strong>
                    <span style="font-size:12px;color:#666;">
                        ${(file.size/1024).toFixed(2)} KB
                    </span>
                </div>
            `;
        } else {
            preview.innerHTML = '';
        }

    });

</script>

@endsection