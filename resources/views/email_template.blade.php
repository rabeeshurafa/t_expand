<table class="table table-striped">
    <tr>{!! $data['message'] !!}</tr>
    {{-- <tr>{!! $data['files_test'] !!}</tr> --}}
    <div style='margin-left:0px;'>
        @foreach ($data['files_attachment'] as $file_attachment)
            <a width='35px' height='35' style='margin-right:1rem;' target='_blank'
                href='@if ($file_attachment['file_links'] && $file_attachment['file_links']['s3']) {{ $file_attachment['file_links']['s3'] }}
                @elseif ($file_attachment['file_links']['ftp'])
                {{ $file_attachment['file_links']['ftp'] }}
                @elseif ($file_attachment['file_links']['dropbox'])
                {{ $file_attachment['file_links']['dropbox'] }}
                @else
                {{ asset('') }}{{ $file_attachment['url'] }} @endif'>
                {{ $file_attachment['real_name'] }}
            </a>
        @endforeach
    </div>
</table>