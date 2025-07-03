<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kalender Booking</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #calendar {
            max-width: 900px;
            margin: 50px auto;
        }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Jadwal Booking Ruangan</h2>

    <div id="calendar"></div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                events: @json($events),
            });

            console.log("Events Loaded:", @json($events)); // Debug
            calendar.render();
        });
    </script>

</body>
</html>
