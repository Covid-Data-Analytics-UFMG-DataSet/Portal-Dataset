jQuery(function ($) {
  $("#type-radio").change(function () {
    if ($("#type-radio").is(":checked")) {
      $("#custom-form__filter-value").val("tipo");
      $("#source-radio").prop("checked", false);
      $("#theme-radio").prop("checked", false);
      $("#custom-select-source").css({
        display: "none",
      });
      $("#custom-select-theme").css({
        display: "none",
      });
      $("#custom-select-type").css({
        display: "block",
      });
    } else {
      $("#custom-form__filter-value").val("");
      $("#custom-select-type").css({
        display: "none",
      });
      $("#custom-select-source").css({
        display: "none",
      });
      $("#custom-select-theme").css({
        display: "none",
      });
    }
  });
  $("#source-radio").change(function () {
    if ($("#source-radio").is(":checked")) {
      $("#custom-form__filter-value").val("fonte");
      $("#type-radio").prop("checked", false);
      $("#theme-radio").prop("checked", false);
      $("#custom-select-theme").css({
        display: "none",
      });
      $("#custom-select-type").css({
        display: "none",
      });
      $("#custom-select-source").css({
        display: "block",
      });
    } else {
      $("#custom-form__filter-value").val("");
      $("#custom-select-source").css({
        display: "none",
      });
      $("#custom-select-type").css({
        display: "none",
      });
      $("#custom-select-theme").css({
        display: "none",
      });
    }
  });
  $("#theme-radio").change(function () {
    if ($("#theme-radio").is(":checked")) {
      $("#custom-form__filter-value").val("tema");
      $("#type-radio").prop("checked", false);
      $("#source-radio").prop("checked", false);
      $("#custom-select-source").css({
        display: "none",
      });
      $("#custom-select-type").css({
        display: "none",
      });
      $("#custom-select-theme").css({
        display: "block",
      });
    } else {
      $("#custom-form__filter-value").val("");
      $("#custom-select-theme").css({
        display: "none",
      });
      $("#custom-select-type").css({
        display: "none",
      });
      $("#custom-select-source").css({
        display: "none",
      });
    }
  });
});
