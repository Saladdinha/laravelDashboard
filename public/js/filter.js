$(document).ready(function () {

  $(".select").on("click", function () {
    var select = $(this)
    if (select.hasClass("selected")) {
      select.removeClass("selected")
    } else {
      select.addClass("selected")
    }
  })

  $(".select").on("mouseleave", function () {
    $(".select.selected").removeClass("selected")
  })

  $("input.date").on("input", function () {
    var val = $(this).val().replace(/[^0-9\-]/g, '');
    if (val.length <= 10) {
      if (val.length == 2 || val.length == 5) {
        val = val + "-"
      }
      $(this).val(val)
    } else {
      return
    }
  })

  $(".submitFilter .filterBtn").on("click", function () {
    var form = new FormData()
    var fieldsSelect = []
    $.each($(".filterBox.select.fieldsSelect input.inputOption:checked"), function (i, e) {
      fieldsSelect.push($(this).val())
    })
    $(".submitForm input[name='keyword']").val($(".filterBox input.keyword").val())
    $(".submitForm input[name='fields']").val(fieldsSelect)
    $(".submitForm input[name='value']").val($(".filterBox input.value").val())
    $(".submitForm input[name='discount_value']").val($(".filterBox input.discount_value").val())
    $(".submitForm input[name='enrollment_status']").val($(".filterBox.select.enrollment_status input:checked").val())
    $(".submitForm input[name='payment_status']").val($(".filterBox.select.payments_status input:checked").val())
    $(".submitForm input[name='payment_type']").val($(".filterBox.select.payment_type input:checked").val())
    $(".submitForm input[name='enrollments_qty']").val($(".filterBox input.enrollments_qty").val())
    $(".submitForm input[name='init_date']").val($(".filterBox input.init_date").val())
    $(".submitForm input[name='end_date']").val($(".filterBox input.end_date").val())
    $(".submitForm").submit()
  })
});