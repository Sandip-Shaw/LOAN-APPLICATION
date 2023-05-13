<!DOCTYPE html>
@extends('backend.layouts.master')

@section('title')
Profile Create - Admin Panel
@endsection
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Fullcalender CRUD Events in Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
</head>
<body>
@section('admin-content')
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Calender & Events</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Calender & Events</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->
    <div class="container mt-5" style="max-width: 700px">
        <h2 class="h2 text-center mb-5 border-bottom pb-3">Calender & Events</h2>
        <div id='full_calendar_events'></div>
    </div>

@endsection

    {{-- Scripts --}}
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" ref="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <script>
        $(document).ready(function () {
            var SITEURL = "{{ url('/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calendar = $('#full_calendar_events').fullCalendar({
                editable: true,
                editable: true,
                events: SITEURL + "/calendar-event",
                // displayEventTime: true,
                // eventRender: function (event, element, view) {
                //     if (event.allDay === 'true') {
                //         event.allDay = true;
                //     } else {
                //         event.allDay = false;
                //     }
                // },
                // selectable: true,
                // selectHelper: true,
                // select: function (event_start, event_end, allDay) {
                //     var event_name = prompt('Event Name:');
                //     if (event_name) {
                //         var event_start = $.fullCalendar.formatDate(event_start, "Y-MM-DD HH:mm:ss");
                //         var event_end = $.fullCalendar.formatDate(event_end, "Y-MM-DD HH:mm:ss");
                //         $.ajax({
                //             url: SITEURL + "/calendar-crud-ajax",
                //             data: {
                //                 event_name: event_name,
                //                 event_start: event_start,
                //                 event_end: event_end,
                //                 type: 'create'
                //             },
                //             type: "POST",
                //             success: function (data) {
                //                 displayMessage("Event created.");
                //                 calendar.fullCalendar('renderEvent', {
                //                     id: data.id,
                //                     title: event_name,
                //                     start: event_start,
                //                     end: event_end,
                //                     allDay: allDay
                //                 }, true);
                //                 calendar.fullCalendar('unselect');
                //             }
                //         });
                //     }
                // },
                // eventDrop: function (event, delta) {
                //     var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                //     var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                //     $.ajax({
                //         url: SITEURL + '/calendar-crud-ajax',
                //         data: {
                //             title: event.event_name,
                //             start: event_start,
                //             end: event_end,
                //             id: event.id,
                //             type: 'edit'
                //         },
                //         type: "POST",
                //         success: function (response) {
                //             displayMessage("Event updated");
                //         }
                //     });
                // },
                // eventClick: function (event) {
                //     var eventDelete = confirm("Are you sure?");
                //     if (eventDelete) {
                //         $.ajax({
                //             type: "POST",
                //             url: SITEURL + '/calendar-crud-ajax',
                //             data: {
                //                 id: event.id,
                //                 type: 'delete'
                //             },
                //             success: function (response) {
                //                 calendar.fullCalendar('removeEvents', event.id);
                //                 displayMessage("Event removed");
                //             }
                //         });
                //     }
                // }
            });
            console.log(calendar);
        });
        function displayMessage(message) {
            toastr.success(message, 'Event');            
        }
    </script>
</body>
</html>