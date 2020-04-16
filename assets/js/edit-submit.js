jQuery(document).ready(function($) {
  // Initial category set
  if ($('#inputCategory').val()) {
    displayFields();
  }

  // Detect category change
  $('#inputCategory').change(function() {
    if ($(this).val()) {
      displayFields();
    }
  });

  // Dipslay edit/submit secondary field sections
  function displayFields() {
    $('#listing-edit-sub-form').addClass("has-category");
  }
  
});
