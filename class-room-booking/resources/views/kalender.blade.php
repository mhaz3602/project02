<!DOCTYPE html>
<html>
<head>
    <title>Kalender Ketersediaan Ruangan</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.min.js'></script>
</head>
<body>
    <div id='calendar'></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                events: @json($events) // langsung masukkan dari controller
            });

            calendar.render();
        });
    </script>
</body>
</html>