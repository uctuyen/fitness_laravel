<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/locale-all.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@section('script')
    @include('backend.dashboard.component.breadcumb', ['title' => $config['seo']['index']['title']])
    <div class="row mt20">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $config['seo']['index']['table'] }}</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form action="{{ route('calendar.index') }}">
                        <div class="uk-flex uk-flex-middle">
                        </div>
                        <div class="action">

                            <body>
                                <!-- Button trigger modal -->
                                <!-- Modal -->
                                <div class="modal fade" id="calendarModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="class">Class:</label>
                                                <select id="classSelect" name="class_id" class="form-control">
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}">
                                                            {{ $class->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span id="classTitleError" class="text-danger"></span>
                                                <label for="trainer">Trainer:</label>
                                                <select id="trainerSelect" name="trainer_id" class="form-control">
                                                    @foreach ($trainers as $trainer)
                                                        <option value="{{ $trainer->id }}">
                                                            {{ $trainer->first_name . ' ' . $trainer->last_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span id="trainerTitleError" class="text-danger"></span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="Closebtn" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" id="Savebtn" class="btn btn-primary">Save
                                                    changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="row mt20">
                                            <div class="col-lg-12">
                                                <div id="calendar"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <script>
                                    $(document).ready(function() {
                                        var calendar = @json($events);
                                        console.log(calendar);
                                        var selectedStart;
                                        var selectedEnd;
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        }); 
                                        
                                        $('#calendar').fullCalendar({
                                            header: {
                                                'left': 'prev,next today',
                                                'center': 'title',
                                                'right': 'month,agendaWeek,agendaDay'
                                            },
                                            editable: true,
                                            eventDrop: function(event) {
                                                var id = event.id;
                                                console.log(event.id);
                                                var start_date = moment(event.start).format('YYYY-MM-DD HH:mm');
                                                var end_date = moment(event.end).format('YYYY-MM-DD HH:mm');
                                                $.ajax({
                                                    url: "{{ route('calendar.update','' ) }}" + '/' + id,
                                                    type: 'PATCH',
                                                    dataType: 'json',
                                                    data: {
                                                        start_date: start_date,
                                                        end_date: end_date
                                                    },
                                                    success: function(response) {
                                                        swal("Good job!", "cập nhật lịch thành công!", "success");

                                                    },
                                                    error: function(error) {
                                                        if (error.responseJSON && error.responseJSON.errors) {
                                                            console.log(error);
                                                        }
                                                    }
                                                }); 
                                            },
                                            events: calendar,
                                            selectable: true,
                                            selectHelper: true,
                                            locale: 'vi',
                                            select: function(start, end, allDay) {
                                                selectedStart = start;
                                                selectedEnd = end;
                                                $('#calendarModal').modal('toggle');
                                            },
                                            eventClick: function(calEvent, jsEvent, view) {
                                                $('#calendarModal').on('show.bs.modal', function() {
                                                    console.log('Modal is about to be shown');
                                                });
                                                $('#calendarModal').modal('show');
                                            }
                                        }); 
                                    
                                        $('#Closebtn').click(function() {
                                            // Perform any additional actions here...
                                            // For example, you can clear the form fields
                                            $('#classSelect').val('');
                                            $('#trainerSelect').val('');
                                            // Close the modal
                                            $('#calendarModal').modal('hide');
                                        });
                                    
                                        $('#Savebtn').click(function() {
                                            var classValue = $('#classSelect option:selected').text().trim();
                                            console.log(classValue);
                                            var trainerValue = $('#trainerSelect option:selected').text().trim();
                                            console.log(trainerValue);
                                            if (selectedStart) {
                                                var start_date = moment(selectedStart).format('YYYY-MM-DD HH:mm');
                                                console.log(start_date);
                                            }
                                            if (selectedEnd) {
                                                var end_date = moment(selectedEnd).format('YYYY-MM-DD HH:mm');
                                                console.log(end_date);
                                            }
                                    
                                            $.ajax({
                                                url: "{{ route('calendar.save') }}",
                                                type: 'POST',
                                                dataType: 'json',
                                                data: {
                                                    title: $('#classSelect option:selected').text().trim() + ' ' + $(
                                                        '#trainerSelect option:selected').text().trim(),
                                                    class_id: $('#classSelect').val(),
                                                    trainer_id: $('#trainerSelect').val(),
                                                    start_date: start_date,
                                                    end_date: end_date
                                                },
                                                success: function(response) {
                                                    $('#calendar').fullCalendar('renderEvent', {
                                                        title: response.classValue + ' ' + trainerValue,
                                                        start: response.start_date,
                                                        end: response.end_date,
                                                    }, true); // make the event "stick"
                                                    $('#calendarModal').modal('hide');
                                                },
                                                error: function(error) {
                                                    if (error.responseJSON && error.responseJSON.errors) {
                                                        $('#classTitleError').html(error.responseJSON.errors.class_id);
                                                        $('#trainerTitleError').html(error.responseJSON.errors.trainer_id);
                                                        $('#titleError').html(error.responseJSON.errors.title)
                                                    }
                                                }
                                            }); 
                                        }); 
                                    }); 
                                    </script>
                            </body>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
