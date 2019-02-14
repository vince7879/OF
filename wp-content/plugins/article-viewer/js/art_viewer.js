jQuery(document).ready(function($) {
  var url = ajax_object.api_url;

  //HOMEPAGE / LIST OF CATEGORIES
  //INITIAL CALL AJAX TO GET ALL CATEGORIES
  $.ajax({
    type: "GET",
    url: url + "/wp-json/wp/v2/categories",
    data: {},
    dataType: "json",
    success: function(res) {
      displayCategories(res);
    },
    error: function(res) {
      console.log("error: " + res);
    }
  });

  //FUNCTION TO DISPLAY THE LIST OF ALL CATEGORIES ON THE HOMEPAGE
  function displayCategories(json) {
    html = "<ul>";
    $.each(json, function(index, value) {
      if (value.count) {
        html +=
          "<li><a href='" +
          url +
          "/viewer?category=" +
          value.id +
          "'>" +
          value.name +
          "</a></li>";
      }
    });
    html += "</ul>";
    $("#categories_viewer").html(html);
  }

  //PAGE ARTICLE VIEWER
  //FUNCTION TO GET URL PARAMETERS
  var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
      sURLVariables = sPageURL.split("&"),
      sParameterName,
      i;

    for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split("=");

      if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined
          ? true
          : decodeURIComponent(sParameterName[1]);
      }
    }
  };

  //IF THE USER IS ON THE "ARTICLE VIEWER" PAGE AFTER CHOOSING A CATEGORY ON THE HOMEPAGE
  //RUN THE PROCESS TO DISPLAY ARTICLES BY CATEGORY
  if (top.location.pathname === "/wp-onefootball/viewer/") {
    displayLastPostByCategory();
  }

  //CALL AJAX TO GET THE MOST RECENT ARTICLE IN A GIVEN CATEGORY FROM THE API
  function displayLastPostByCategory() {
    var categoryId = getUrlParameter("category");

    $.ajax({
      type: "GET",
      url:
        url +
        "/wp-json/wp/v2/posts?filter[orderby]=date&order=desc&per_page=1&categories=" +
        categoryId,
      data: {},
      dataType: "json",
      success: function(res) {
        displayRequestedPost(res);
        displayArrows(res[0].date, categoryId);
      },
      error: function(res) {
        console.log("error: " + res);
      }
    });
  }

  //FUNCTION TO DISPLAY THE MOST RECENT ARTICLE
  function displayRequestedPost(json) {
    html = "<article id=" + json[0].id + ">";
    html += "<h2>" + json[0].title.rendered + "</h2>";
    html += json[0].content.rendered;
    html += "</article>";

    $("#article_viewer").html(html);
  }

  //FUNCTION TO DISPLAY APPROPRIATE NAVIGATION ARROWS
  function displayArrows(date, categoryId) {
    var direction = ["before", "after"];
    $.each(direction, function(index, value) {
      $.ajax({
        type: "GET",
        url:
          url +
          "/wp-json/wp/v2/posts?per_page=1&" +
          value +
          "=" +
          date +
          "&categories=" +
          categoryId,
        data: {},
        dataType: "json",
        success: function(res) {
          if (!res.length) {
            $("#" + value + "").hide();
          } else {
            $("#" + value + "").show();
          }
        },
        error: function(res) {
          console.log("error: " + res);
        }
      });
    });
  }

  //FUNCTION TO NAVIGATE THROUGH ARTICLES BY PRESSING "J" OR "K" KEYS
  $(window).keypress(function(e) {
    var keyPressed = e.key;
    var currentPostId = $("#article_viewer article").attr("id");
    if (keyPressed === "k" || keyPressed === "K") {
      getCurrentPost(currentPostId, "before", "desc");
    }
    if (keyPressed === "j" || keyPressed === "J") {
      getCurrentPost(currentPostId, "after", "asc");
    }
  });

  //FUNCTION TO GET CURRENT ARTICLE DISPLAYED
  function getCurrentPost(id, direction, order) {
    //CALL AJAX DE GET CURRENT POST
    $.ajax({
      type: "GET",
      url: url + "/wp-json/wp/v2/posts/" + id,
      data: {},
      dataType: "json",
      success: function(res) {
        displayNextPost(res, direction, order);
      },
      error: function(res) {
        console.log("error: " + res);
      }
    });
  }

  //FUNCTION TO DISPLAY ANOTHER ARTICLE ACCORDING TO THE KEY PRESSED ("J" OR "K")
  function displayNextPost(json, direction, order) {
    var categoryId = getUrlParameter("category");

    $.ajax({
      type: "GET",
      url:
        url +
        "/wp-json/wp/v2/posts?per_page=1&order=" +
        order +
        "&" +
        direction +
        "=" +
        json.date +
        "&categories=" +
        categoryId,
      data: {},
      dataType: "json",
      success: function(res) {
        if (res.length) {
          displayRequestedPost(res);
          displayArrows(res[0].date, categoryId);
        } else {
          return;
        }
      },
      error: function(res) {
        console.log("error: " + res);
      }
    });
  }
});
