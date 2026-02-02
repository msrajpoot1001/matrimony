@extends(auth()->id() ? 'instructor.master_layout' : 'admin.master_layout')

@section('title')
    <title>Quiz Result</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">Quiz Result</h3>
    <p class="crancy-header__text">Manage >> Quiz Result</p>
@endsection

@section('body-content')
    <!-- crancy Dashboard -->
    <section class="crancy-adashboard crancy-show">
        <div class="container container__bscreen">
            <div class="row">
                <div class="col-12">
                    <div class="crancy-body">
                        <div class="crancy-dsinner">

                            <div class="crancy-table crancy-table--v3 mg-top-30">

                                <!-- Create Button -->
                                <div class="crancy-customer-filter">
                                    <div
                                        class="crancy-customer-filter__single 
                                        crancy-customer-filter__single--csearch d-flex 
                                        items-center justify-between create_new_btn_box">

                                        <div
                                            class="crancy-header__form crancy-header__form--customer 
                                            create_new_btn_inline_box">

                                            <h4 class="crancy-product-card__title">Quiz Result</h4>
                                            <br>

                                        </div>
                                        <div className="row">

                                            <div className="col-lg-6">

                                                <label>Test Package</label>
                                                <select>
                                                    <option>Select One</option>
                                                    @foreach ($test_package as $item)
                                                        <option>{{ $item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div className="col-lg-6">
                                                <label>User</label>

                                                <select>
                                                    <option>Select One</option>
                                                    @foreach ($user as $item)
                                                        <option>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div className="col-lg-6">
                                                <label>User</label>

                                                <select>
                                                    <option>Select One</option>
                                                    @foreach ($test as $item)
                                                        <option>{{ $item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Create Button -->


                                <!-- Table -->
                                <div id="crancy-table__main_wrapper" class="dt-bootstrap5 no-footer">
                                    <table class="crancy-table__main crancy-table__main-v3 no-footer" id="dataTable">
                                        <thead class="crancy-table__head">
                                            <tr>
                                                <th>Sr</th>
                                                <th>Student</th>
                                                <th>Package</th>
                                                <th>Test</th>
                                                <th>Total Q</th>
                                                <th>Attempted</th>
                                                <th>Correct</th>
                                                <th>Wrong</th>
                                                <th>Total Marks</th>
                                                <th>Obtained</th>
                                                <th>Percentage</th>
                                                <th>Status</th>
                                                <th>Started At</th>
                                                <th>Submitted At</th>
                                            </tr>
                                        </thead>

                                        <tbody class="crancy-table__body">
                                            @foreach ($results as $index => $result)
                                                <tr>
                                                    <td>
                                                        <h4>{{ $index + 1 }}</h4>
                                                    </td>

                                                    <td>
                                                        <h4>{{ $result->user->name ?? 'N/A' }}</h4>
                                                    </td>

                                                    <td>
                                                        <h4>{{ $result->package->title ?? 'N/A' }}</h4>
                                                    </td>

                                                    <td>
                                                        <h4>{{ $result->test->title ?? 'N/A' }}</h4>
                                                    </td>

                                                    <td>{{ $result->total_questions }}</td>
                                                    <td>{{ $result->attempted_questions }}</td>
                                                    <td>{{ $result->correct_answers }}</td>
                                                    <td>{{ $result->wrong_answers }}</td>

                                                    <td>{{ $result->total_marks }}</td>
                                                    <td>{{ $result->obtained_marks }}</td>

                                                    <td>
                                                        <span class="badge bg-info">
                                                            {{ number_format($result->percentage, 2) }}%
                                                        </span>
                                                    </td>

                                                    <td>
                                                        @if ($result->status === 'completed')
                                                            <span class="badge bg-success">Completed</span>
                                                        @else
                                                            <span class="badge bg-warning">Pending</span>
                                                        @endif
                                                    </td>

                                                    <td>{{ optional($result->started_at)->format('d-m-Y H:i') }}</td>
                                                    <td>{{ optional($result->submitted_at)->format('d-m-Y H:i') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <!-- /Table -->

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>Are you realy want to delete this item</p>
                </div>

                <div class="modal-footer">
                    <form action="" id="item_delect_confirmation" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">
                            Yes, Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection

@push('js_section')
    <script>
        "use strict";

        function itemDeleteConfrimation(id) {
            $("#item_delect_confirmation").attr("action",
                '{{ url('admin/testpackage') }}' + "/" + id);
        }
    </script>
@endpush
