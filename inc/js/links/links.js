$(document).ready(function () {});

// LINKS
// INPUT OPEN MODAL FORM - CREATE SUPPLY COMPANY
function btnCreateLink() {
  var server = window.location.hostname;
  var urlAjax = "https://" + server + "/links/new";
  $.ajax({
    url: urlAjax, //the page containing php script
    type: "post", //request type,
    data: {
      registration: "yes",
    },
    success: function (response) {
      // Add response in Modal body
      $("#bodyModalCreateLink").html(response);
      $("#bodyModalCreateLink").show();
      $("#btnAddLink").show();
      $("#createLinkMessageErr").hide();
      $("#createLinkMessageOk").hide();
    },
  });
}

// AJAX PROCESS > PHP - MODAL FORM - CREATE NEW LINK
$(function () {
  $("#btnAddLink").click(function () {
    // check values
    $("#createLinkMessageErr").hide();

    // Stop form from submitting normally
    event.preventDefault();
    var server = window.location.hostname;
    var urlAjax = "https://" + server + "/links/process/new";

    $.ajax({
      type: "POST",
      url: urlAjax,
      data: {
        nom: $("#nom").val(),
        web: $("#web").val(),
        cat: $("#cat").val(),
        lang: $("#lang").val(),
        tipus: $("#tipus").val(),
        linkCreated: $("#linkCreated").val(),
      },
      success: function (response) {
        if (response.status == "success") {
          // Add response in Modal body
          $("#createLinkMessageOk").show();
          $("#createLinkMessageErr").hide();
          $("#bodyModalNewLink").hide();
          $("#btnAddLink").hide();
        } else {
          $("#createLinkMessageErr").show();
          $("#createLinkMessageOk").hide();
        }
      },
    });
  });
});

// LINKS
// INPUT UPDATE MODAL FORM - CREATE SUPPLY COMPANY
function modalUpdateLink(idLink) {
  var idLink = idLink;
  var server = window.location.hostname;
  var urlAjax = "https://" + server + "/links/update";
  $.ajax({
    url: urlAjax, //the page containing php script
    type: "post", //request type,
    data: {
      registration: "yes",
      idLink: idLink,
    },
    success: function (response) {
      // Add response in Modal body
      $("#bodyModalUpdateLink").html(response);
      $("#bodyModalUpdateLink").show();
      $("#btnUpdateLink").show();
      $("#updateLinkMessageErr").hide();
      $("#updateLinkMessageOk").hide();
    },
  });
}

// AJAX PROCESS > PHP - MODAL FORM - UPDATE LINK
$(function () {
  $("#btnUpdateLink").click(function () {
    // check values
    $(".show_conversation2").hide();

    // Stop form from submitting normally
    event.preventDefault();
    var server = window.location.hostname;
    var urlAjax = "https://" + server + "/links/process/update";

    $.ajax({
      type: "POST",
      url: urlAjax,
      data: {
        id: $("#id").val(),
        nom: $("#nom").val(),
        web: $("#web").val(),
        cat: $("#cat").val(),
        lang: $("#lang").val(),
        tipus: $("#tipus").val(),
        linkCreated: $("#linkCreated").val(),
      },
      success: function (response) {
        if (response.status == "success") {
          // Add response in Modal body
          $("#updateLinkMessageOk").show();
          $("#updateLinkMessageErr").hide();
          $("#botoSave").hide();
        } else {
          $("#updateLinkMessageErr").show();
          $("#updateLinkMessageOk").hide();
        }
      },
    });
  });
});
