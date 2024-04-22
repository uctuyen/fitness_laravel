@include('backend.dashboard.component.breadcumb', ['title' => $config['seo']['create']['title']])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/locale-all.js"></script>
@section('script')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>

    <body>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <label for="trainer">Trainer:</label>
                        <select id="trainerSelect" name="trainer_id" class="form-control">
                            @foreach ($trainers as $trainer)
                                <option value="{{ $trainer->id }}">
                                    {{ $trainer->first_name . ' ' . $trainer->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="Savebtn" class="btn btn-primary">Save changes</button>
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
                })
                $('#calendar').fullCalendar({
                    header: {
                        'left': 'prev,next today',
                        'center': 'title',
                        'right': 'month,agendaWeek,agendaDay'
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
                        })
                        $('#calendarModal').modal('show');
                    }
                })
        
                $('#Savebtn').click(function(){
                    var classValue = $('#classSelect option:selected').text();
                    console.log(classValue);
        
                    var trainerValue = $('#trainerSelect option:selected').text();
                    console.log(trainerValue);
        
                    if (selectedStart) {
                        var start_date = moment(selectedStart).format('YYYY-MM-DD HH:mm:ss');
                        console.log(start_date);
                    }
                    if (selectedEnd) {
                        var end_date = moment(selectedEnd).format('YYYY-MM-DD HH:mm:ss');
                        console.log(end_date);
                    }
                    $.ajax({
                        url: '{{ route('calendar.store') }}',
                        type: 'POST',
                        data: {
                            class: classValue,
                            trainer: trainerValue,
                            start_date: start_date,
                            end_date: end_date
                        },
                        success: function(data) {
                            console.log(data);
                            $('#calendar').fullCalendar('refetchEvents');
                        },
                        error: function(data) {
                            console.log(data);
                            $('#calendar').fullCalendar('refetchEvents');
                        }
                    })
                })
            })
        </script>
    </body>

    </html>
