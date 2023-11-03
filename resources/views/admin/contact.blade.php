<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/admin/brand.css') }}">
    </style>
</head>

<body>
    @extends('admin.dashboard')
    @section('content')
    <div class="container">
        <div class="header">
            <h1>Feedback</h1>
        </div>
        @if (!empty($contacts))
        <div class="content-brand">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Content</th>
                        <th>Created_at</th>
                        <th class="actions">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                    <tr>
                        <td data-id="{{ $contact->id }}">{{ $contact->id }}</td>
                        <td class="name" data-id="{{ $contact->id }}">{{ $contact->name }}</td>
                        <td class="email" data-id="{{ $contact->id }}">{{ $contact->email }}</td>
                        <td data-id="{{ $contact->id }}">{{ $contact->content }}</td>
                        <td class="date" data-id="{{ $contact->id }}">{{ $contact->created_at->format('d/m/Y')}}</td>
                        <td class="action-buttons">
                            <form method="POST" action="{{ route('contact.delete', ['id' => $contact->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure to delete?')"><i
                                        class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>No contact found.</p>
        @endif
    </div>
    @endsection
</body>

</html>