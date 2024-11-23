@extends('layouts.adminNavigation')

@section('page-title', 'Manage Messages')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Messages</h4>

                @if(session('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
            <div class="card-body">

                <nav id="messages-table-tab"
                     class="messages-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                    <a class="flex-sm-fill text-sm-center nav-link {{ $search_status === '' ? 'active bg-info text-white font-weight-bold' : 'text-dark' }}"
                       href="?status=" role="tab"
                       style="background-color: {{ $search_status === '' ? '#007bff' : 'transparent' }}; color: {{ $search_status === '' ? '#fff' : 'inherit' }};">
                        <i class="fas fa-list-ul"></i> All
                    </a>
                    <a class="flex-sm-fill text-sm-center nav-link {{ $search_status === 'read' ? 'active bg-success text-white font-weight-bold' : 'text-success' }}"
                       href="?status=read" role="tab"
                       style="background-color: {{ $search_status === 'read' ? '#28a745' : 'transparent' }}; color: {{ $search_status === 'read' ? '#fff' : 'inherit' }};">
                        <i class="fas fa-check-circle"></i> Read
                    </a>
                    <a class="flex-sm-fill text-sm-center nav-link {{ $search_status === 'unread' ? 'active bg-danger text-white font-weight-bold' : 'text-danger' }}"
                       href="?status=unread" role="tab"
                       style="background-color: {{ $search_status === 'unread' ? '#dc3545' : 'transparent' }}; color: {{ $search_status === 'unread' ? '#fff' : 'inherit' }};">
                        <i class="fas fa-times-circle"></i> Not Read
                    </a>
                </nav>


                <div class="table-responsive">
                    <table class="table text-center">
                        <thead class="text-primary">
                        <th> User ID </th>
                        <th> Message </th>
                        <th> Date </th>
                        <th> Status </th>
                        <th> Read </th>
                        <th> Action </th>
                        </thead>
                        <tbody>
                        @foreach ($messages as $message)
                            <tr>
                                <td>{{ $message->sender_id }}</td>
                                <td>{{ $message->content }}</td>
                                <td>{{ $message->created_at }}</td>
                                <td>
                                    <span class="badge bg-{{ $message->is_read === 0 ? 'danger' : 'success' }}" style="font-size: 14px;">
                                        {{ $message->is_read === 0 ? 'Not Read' : 'Read' }}
                                    </span>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" onchange="toggleStatus(event, {{ $message->id }})" {{ $message->is_read === 1 ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <a href="#" class="btn-sm"
                                       data-bs-toggle="modal" data-bs-target="#replayModal" data-id="{{ $message->id }}" data-message="{{ $message->content }}" data-reply="{{ $message->reply_content }}">
                                        Reply
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Reply Modal (Pop-up) -->
    <div class="modal fade" id="replayModal" tabindex="-1" aria-labelledby="replayModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replayModalLabel">Reply to Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="replyForm" method="POST" action="{{ route('admin.manageMessages.replyMessage') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="message_id" id="message_id">
                        <div class="mb-3">
                            <label for="message_content" class="form-label">Message Content</label>
                            <textarea class="form-control" id="message_content" rows="3" readonly></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="reply_content" class="form-label">Your Reply</label>
                            <textarea class="form-control" name="reply_content" id="reply_content" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Reply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Function to update message status (is_read)
        function toggleStatus(event, messageId) {
            const isRead = event.target.checked ? 1 : 0;

            fetch(`/admin/manageMessages/${messageId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ is_read: isRead }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the badge dynamically
                        const statusTd = document.getElementById('status-' + messageId);
                        if (isRead === 1) {
                            statusTd.innerHTML = `<span class="badge bg-success" style="font-size: 14px;">Read</span>`;
                        } else {
                            statusTd.innerHTML = `<span class="badge bg-danger" style="font-size: 14px;">Not Read</span>`;
                        }
                        console.log('Status updated');
                    }
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                });
        }

        // Populate modal with message content and existing reply content
        const replyModal = document.getElementById('replayModal');
        replyModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const messageId = button.getAttribute('data-id');
            const messageContent = button.getAttribute('data-message');
            const replyContent = button.getAttribute('data-reply');

            // Update the modal's content.
            const modalMessageContent = replyModal.querySelector('.modal-body #message_content');
            const modalReplyContent = replyModal.querySelector('.modal-body #reply_content');
            const modalMessageId = replyModal.querySelector('#message_id');

            modalMessageContent.value = messageContent;
            modalReplyContent.value = replyContent || '';  // If there's no reply, leave it empty
            modalMessageId.value = messageId;
        });

        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>

@endsection
