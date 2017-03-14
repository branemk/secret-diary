 /*global $ */
 /* jshint browser: true */
 /*jshint devel:true */


 //load data on page load
 $(document).ready(function () {
     $.ajax({
         method: "POST",
         url: "getallmemos.php",
         data: {
             userid: $("#hidden").text().trim()
         }
     }).done(function (msg) {

         $("#textcontainerrow").append(msg);
         CreateButtonClickListener();
         console.log(msg);

     }).fail(function () {
         console.log("fail");
     });
 });
 

 $("#create").click(function () {
     
     $("#textmodal").val("");
     $("#modaldelete").hide();
     $("#modalupdate").hide();
     $("#modalsave").show();
     $('#myModal').modal('show');
 });

 $("#modalsave").click(function () {
     
     SaveMemo();


 });


 function SaveMemo() {
     $.ajax({
         method: "POST",
         url: "createnew.php",
         data: {
             text: $("#textmodal").val(),
             userid: $("#hidden").text().trim(),
         }
     }).done(function (msg) {
         console.log(msg.trim());
         if (msg.trim() == "Tablecreated") {
             console.log("hi");
             SaveMemo();
         } else {
             console.log(msg);
             console.log("hello");
             $('#myModal').modal('hide');
             location.reload();
         }

     }).fail(function () {
         console.log("fail");
     });


 }
//Edit button click listener
 function CreateButtonClickListener() {
     
     $(".editbutton").click(function () {

         var id = $(this).attr('id');
         
         //we are getting id number from editbutton id to know which text to show into modal
         var idnumber = parseInt(id.replace(/^[^0-9]+/, ''), 10);
         
         var text = $("#textarea" + idnumber).text();
         console.log(text);
         $("#textmodal").val(text.trim());
         $("#modalsave").hide();
         $("#modalupdate").show();
         $("#modaldelete").show();

         CreateUpdateButtonClickListener(idnumber);
         CreateDeleteButtonClickListener(idnumber);
         $('#myModal').modal('show');
     });

 }


 function CreateUpdateButtonClickListener(index) {
     $("#modalupdate").click(function () {

         $.ajax({
             method: "POST",
             url: "updatedatabase.php",
             data: {
                 text: $("#textmodal").val(),
                 userid: $("#hidden").text().trim(),
                 id: index
             }
         }).done(function (msg) {

             console.log(msg);
             location.reload();

         }).fail(function () {
             console.log("fail");
         });

         $('#myModal').modal('hide');

     });

 }

 function CreateDeleteButtonClickListener(index) {
     $("#modaldelete").click(function () {

         $.ajax({
             method: "POST",
             url: "deletememo.php",
             data: {
                 text: $("#textmodal").val(),
                 userid: $("#hidden").text().trim(),
                 id: index
             }
         }).done(function (msg) {

             console.log(msg);
             location.reload();

         }).fail(function () {
             console.log("fail");
         });

         $('#myModal').modal('hide');

     });

 }

