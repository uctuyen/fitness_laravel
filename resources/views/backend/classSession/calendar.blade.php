@include('backend.dashboard.component.breadcumb', ['title' => $config['seo']['create']['title']])

<div id="calendar"></div>
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarId = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarId, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            events: function(fetchInfo, successCallback, failureCallback) {
                $.ajax({
                    url: '/getEvents', // Đường dẫn đến hàm getEvents trong controller
                    type: 'GET',
                    success: function(data) {
                        var events = [];
                        $.each(data, function(index, value){
                            events.push({
                                title: value.title, // Sửa tên thuộc tính
                                start: value.start, // Sửa tên thuộc tính
                                end: value.end, // Sửa tên thuộc tính
                            });
                        });
                        successCallback(events);
                    },
                    error: function() {
                        failureCallback();
                    }
                });
            }
        });
        calendar.render();
    });
</script>