@extends('admin.master')
@section('title')
All Users
@stop
@section('content')
 <div class="title-bar">
    <h4 style="float:left">All Users</h4>
 </div>
 
 <div id="responsiveTables" class="mb-5">
    <div class="card">
        <div class="card-body">
            <div id="calendar"></div>
        </div>    
    </div>  
</div>         







@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js" integrity="sha512-cJMgI2OtiquRH4L9u+WQW+mz828vmdp9ljOcm/vKTQ7+ydQUktrPVewlykMgozPP+NUBbHdeifE6iJ6UVjNw5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function(){
        
        $.ajaxSetup({
             headers:{
                 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
             }
         });
     
         var calendar = $('#calendar').fullCalendar({
             editable:true,
             header:{
                 left:'prev,next today',
                 center:'title',
                 right:'month,agendaWeek,agendaDay'
             },
             events:'/joursferies',
             selectable:true,
             selectHelper: true,
             select:function(start, end, allDay)
             {
                 var title = prompt('Event Title:');
     
                 if(title)
                 {
                     var start = $.fullCalendar.formatDate(start, 'Y-MM-DD');
     
                     var end = $.fullCalendar.formatDate(end, 'Y-MM-DD');
     
                     console.log(start);
     
                     $.ajax({
                         url:"/joursferies/action",
                         type:"POST",
                         data:{
                             title: title,
                             start: start,
                             end: end,
                             type: 'add'
                         },
                         success:function(data)
                         {
                             calendar.fullCalendar('refetchEvents');
                             alert("Event Created Successfully");
                         }
                     })
                 }
             },
             editable:true,
             eventResize: function(event, delta)
             {
                 var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                 var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                 var title = event.title;
                 var id = event.id;
                 $.ajax({
                     url:"/joursferies/action",
                     type:"POST",
                     data:{
                         title: title,
                         start: start,
                         end: end,
                         id: id,
                         type: 'update'
                     },
                     success:function(response)
                     {
                         calendar.fullCalendar('refetchEvents');
                         alert("Event Updated Successfully");
                     }
                 })
             },
             eventDrop: function(event, delta)
             {
                 var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                 var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                 var title = event.title;
                 var id = event.id;
                 $.ajax({
                     url:"/joursferies/action",
                     type:"POST",
                     data:{
                         title: title,
                         start: start,
                         end: end,
                         id: id,
                         type: 'update'
                     },
                     success:function(response)
                     {
                         calendar.fullCalendar('refetchEvents');
                         alert("Event Updated Successfully");
                     }
                 })
             },
     
             eventClick:function(event)
             {
                 if(confirm("Are you sure you want to remove it?"))
                 {
                     var id = event.id;
                     $.ajax({
                         url:"/joursferies/action",
                         type:"POST",
                         data:{
                             id:id,
                             type:"delete"
                         },
                         success:function(response)
                         {
                             calendar.fullCalendar('refetchEvents');
                             alert("Event Deleted Successfully");
                         }
                     })
                 }
             }
         });
       
           
        });
    </script>
@stop
@stop