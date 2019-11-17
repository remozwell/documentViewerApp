//Inicializadores de funciones
$(document).ready(function(){
  $('.sidenav').sidenav();
  $('.collapsible').collapsible();
  $('select').formSelect({
    // "classes" : "validate[required]",
  });
  $('.dropdown-trigger').dropdown();
  $('.modal').modal();
  $('.datepicker').datepicker({
    "format" : "yyyy-mm-dd"
  });
  $('#notMsg').dropdown({
    'alignment': 'right',
    'constrainWidth' : false,
    'coverTrigger' : false,
  });

  updateNav();
  $('table').DataTable({
    paging: true,
    sort: false,
    pageLength: 15,
    pagingType: 'simple_numbers',
    lengthChange: false,
  });

});



function updateNav(){
  var url = $("#main-nav ul").html();
  $("#slide-nav").html(url);
};


$('form').validationEngine({
  'promptPosition': 'bottomLeft',
  'showArrow': 'false'
});

$(".com-container .com-date a").each(function(){
  input = $(this);
  var normalize = input.attr('href').replace(/\n/g,'%0A');
  input.attr('href', normalize);
})


$("#slide-out > li").each(function(){
  var input = $(this);
  var childs = input.find(".collapsible-body li");
  if(childs.length == 0){
    input.hide();
  }
})

$("#dropdown-trigger").click(function(){
  windos.resize();
})

/*
.submit(function() {
  console.log("dfasf");

});

*/