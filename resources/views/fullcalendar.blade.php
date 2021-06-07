@extends('layout.main') @section('content')

<style>
    .fc-center>div {
        display: -ms-flexbox;
        display: flex;
    }
    .fc-toolbar h2 {
        margin: 5px 20px !important;
        font-size: 30px;
    }
    .fc-widget-header{
        background-color: #00ff93;
        color: black;
    }
    .fc-title{
        color:white
    }
    .fc-time{
display:none;    }
  
</style>

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <div class="container max-w-full mx-auto sm:px-4">
      <div class="response"></div>
      <div id='calendar'></div>  
  </div>
</body>

<script>


  $(document).ready(function () {
    var SITEURL = "{{url('/')}}";
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
 
        var calendar = $('#calendar').fullCalendar({
            lang:'fr',
            events: SITEURL + "/fullcalendar",
            displayEventTime: false,
            editable: true,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            
            select: function (start, end, allDay) {
                var title = prompt('Titre ou Date:');
                if (title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
             $.ajax({
               url: SITEURL + "/fullcalendar/create",
              data: 'title=' + title + '&start=' + start + '&end=' + end,
              type: "POST",
            success: function (data) {
            alert("Creer avec succes");         }
     });
     calendar.fullCalendar('renderEvent',
             {
                 title: title,
                 start: start,
                 end: end,
                 allDay: allDay
             },
     true
             );
 }
 calendar.fullCalendar('unselect');
},

eventDrop: function (event, delta) {
         var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
         var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
         $.ajax({
             url: SITEURL + '/fullcalendar/update',
             data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&amp;id=' + event.id,
             type: "POST",
             success: function (response) {
                calendar.fullCalendar('refetchEvents');
                alert('Evenement a jour');             }
         });
     },
     eventResize: function(event) {
   var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
   $.ajax({
    url: SITEURL + '/fullcalendar/update',
    data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&amp;id='+ event.id ,
    type: "POST",
    success: function(json) {
        calendar.fullCalendar('refetchEvents');
     alert("Evenement a jour");
    }
    });
    },
eventClick: function (event) {
 var deleteMsg = confirm("Vous voulez Supprimer?");
 if (deleteMsg) {
     $.ajax({
         type: "POST",
         url: SITEURL + '/fullcalendar/delete',
         data: "&id=" + event.id,
         success: function (response) {
             if(parseInt(response) > 0) {
                 $('#calendar').fullCalendar('removeEvents', event.id);
                 alert("Evenement Supprimer");             }
         }
     });
 }
}

});
});
  function displayMessage(message) {
    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
  }

</script>
@endsection
