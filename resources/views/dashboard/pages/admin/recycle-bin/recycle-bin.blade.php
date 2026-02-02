@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Recycle Bin')

@section('content')
    <div class="row mt-4">
        <div class="col">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Recycle Bin (All Modules)</h4>

                    {{-- ✅ Global Search --}}
                    <input type="text" id="trashSearch" class="form-control w-25" placeholder="Search in trash..."
                        style="min-width:200px;">
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- ✅ Accordion Wrapper (only one open at a time) --}}
                    <div id="trashAccordion">

                        @php $sectionIndex = 0; @endphp

                        @foreach ($trashedData as $modelClass => $items)
                            @php
                                $sectionIndex++;
                                $sectionId = 'trashSection' . $sectionIndex;
                                $modelName = class_basename($modelClass);
                            @endphp

                            <div class="mt-3 trash-module">

                                {{-- ✅ Module header --}}
                                <div class="d-flex justify-content-between align-items-center px-2 py-2"
                                    style="background:#f7f7f7; border-radius:6px; cursor:pointer;" data-bs-toggle="collapse"
                                    data-bs-target="#{{ $sectionId }}"
                                    aria-expanded="{{ $sectionIndex === 1 ? 'true' : 'false' }}">

                                    <h5 class="fw-bold mb-0">
                                        {{ $modelName }}
                                        <span class="text-muted">({{ $items->count() }})</span>
                                    </h5>

                                    <i class="fas fa-angle-down"></i>
                                </div>

                                {{-- ✅ Add data-bs-parent so only one section stays open --}}
                                <div id="{{ $sectionId }}" class="collapse {{ $sectionIndex === 1 ? 'show' : '' }}"
                                    data-bs-parent="#trashAccordion">

                                    <div class="table-responsive mt-2">
                                        <table class="table table-hover mb-0 trash-table">
                                            <thead>
                                                <tr>
                                                    <th>SN.</th>
                                                    <th>Preview</th>
                                                    <th>Deleted At</th>
                                                    <th>Deleted By</th>
                                                    <th>Reason</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse ($items as $item)
                                                    @php
                                                        // ✅ Preview fallback for all models
                                                        $preview =
                                                            $item->name ??
                                                            ($item->title ??
                                                                ($item->email ??
                                                                    ($item->phone ??
                                                                        ($item->service_name ??
                                                                            ($item->business_name ??
                                                                                ($item->full_name ??
                                                                                    '#' . $item->id))))));

                                                        // ✅ Deleted by name if relation exists
                                                        $deletedByName = null;
                                                        if (method_exists($item, 'deletedBy')) {
                                                            $deletedByName = optional($item->deletedBy)->name;
                                                        }
                                                    @endphp

                                                    <tr class="trash-row">
                                                        <td class="v-center">{{ $loop->iteration }}</td>

                                                        <td class="v-center trash-preview">
                                                            {{ $preview }}
                                                        </td>

                                                        <td class="v-center">
                                                            {{ $item->deleted_at ? $item->deleted_at->format('d M Y, h:i A') : '-' }}
                                                        </td>

                                                        <td class="v-center">
                                                            {{ $deletedByName ?? ($item->deleted_by ?? '-') }}
                                                        </td>

                                                        <td class="v-center trash-reason">
                                                            {{ $item->delete_reason ?? '-' }}
                                                        </td>

                                                        <td class="v-center">
                                                            <div style="display:flex; align-items:center; gap:8px;">

                                                                {{-- ✅ Restore Icon --}}
                                                                <form action="{{ route('admin.recyclebin.restore') }}"
                                                                    method="POST" style="margin:0;">
                                                                    @csrf
                                                                    <input type="hidden" name="model"
                                                                        value="{{ $modelClass }}">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $item->id }}">

                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-success btn-icon"
                                                                        title="Restore">
                                                                        <i class="fas fa-undo"></i>
                                                                    </button>
                                                                </form>

                                                                {{-- ✅ Permanent Delete Icon --}}
                                                                <form action="{{ route('admin.recyclebin.forceDelete') }}"
                                                                    method="POST" style="margin:0;"
                                                                    onsubmit="return confirm('Permanent delete? This cannot be undone.')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="model"
                                                                        value="{{ $modelClass }}">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $item->id }}">

                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-danger btn-icon"
                                                                        title="Delete Permanently">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                </form>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center text-muted">
                                                            No deleted items in {{ $modelName }}.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ Client-side search --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("trashSearch");

            if (!searchInput) return;

            searchInput.addEventListener("keyup", function() {
                const term = this.value.toLowerCase();

                document.querySelectorAll(".trash-table .trash-row").forEach(row => {
                    const preview = row.querySelector(".trash-preview")?.innerText.toLowerCase() ||
                        "";
                    const reason = row.querySelector(".trash-reason")?.innerText.toLowerCase() ||
                    "";

                    if (preview.includes(term) || reason.includes(term)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    </script>
@endsection
