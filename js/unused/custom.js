/**
 * @description Responsible for jumping from one content to another based on the clicked tab selector
 * @param { string } tab           selector for the clickable element
 * @param { string } content       selector for the element you want to become visible or active
 * @param { string } activeClass   custom class name for active element
 * @return { null }
 */

function groupTabs(tab, content, activeClass){
  
  var activeClass = activeClass || "active";

  $(tab).click(function(e){
    e.preventDefault();
    $(tab).removeClass(activeClass);
    $(this).addClass(activeClass);
    var link = $(this).attr('href').split('#');
    var group_id = link[1];
    
    $(content).removeClass(activeClass);
    $('#'+group_id+content).addClass(activeClass);
  });
}



/**
 * @description Validate required form fields
 * @param { string } form_id          custom id name for form to validate
 * @param { string } form_class       custom class name for the form for additional selector specificity        
 * @param { string } submit_selector  custom selector for submit button
 * @return { boolean }  false         if there is missing form field that is not filled up
 */

function formValidation(form_id, form_class, submit_selector){
  
    var form_class = form_class || null;
    var submit_selector = submit_selector || 'input[type=submit]';
  
    var raw_form_id = form_id;
    var raw_form_class = form_class;
    
    var form_id = '#'+form_id;
    
    if(form_class == null){
      var form_class = '';
    }else{
      var form_class = '.'+form_class;
    }
    
    var the_form = form_id+form_class+' '+submit_selector;
    
    var error_found = false;
    var error_border = '1px solid #d43f3a';
    
    var field_id;
    var label_id;
    var label_text;
    
    $(the_form).click(function(){
      $(the_form+' input.required, '+the_form+' select.required').each(function(){
        if($(this).attr('type') != 'hidden' && $(this).attr('type') != 'submit'){
          if($(this).val() == ''){
            field_id = $(this).attr('id');
            label_id = field_id+'_label';
            label_id = '#'+label_id;
            label_text = $(label_id).text();
            //alert('Please Input '+label_text);
            $('#'+field_id).css('border', error_border);
            error_found = true;
          }else{
           error_found = false; 
          }
        }
      });
    
      $(the_form+' textarea.required').each(function(){
        if($(this).text() == ''){
          field_id = $(this).attr('id');
          label_id = field_id+'_label';
          label_id = '#'+label_id;
          label_text = $(label_id).text();
          $('#'+field_id).css('border', error_border);
          error_found = true;
        }else{
         error_found = false; 
        }
      });
      
      
      if(error_found){
        alert('Please fill up (*)required fields.')
        return false;
      }
      
    });
}


/**
 * @description Add required symbol for all required form fields
 * @param { string } form_id          custom id name for form to validate
 * @param { string } form_class       custom class name for the form for additional selector specificity  
 * @param { bool } is_label           determine if the one to append to is a label or just the form field
 * @param { string } required_symbol  string to append as a required symbol
 * @return { null }
 */
 
function formAddRequiredSymbol(form_id, form_class, is_label, required_symbol){
  
    var form_class = form_class || null;
    var is_label = is_label || true;
    var required_symbol = required_symbol || '<span class="danger">*</span>';
  
    var raw_form_id = form_id;
    var raw_form_class = form_class;
    
    var form_id = '#'+form_id;
    
    if(form_class == null){
      var form_class = '';
    }else{
      var form_class = '.'+form_class;
    }
    
    var the_form = form_id+form_class;
    
    var field_id;
    var label_id;
    var label_text;
    
    
    $(the_form+' .required').each(function(){
      if($(this).attr('type') != 'hidden' && $(this).attr('type') != 'submit'){

        field_id = $(this).attr('id');
        if(is_label){
          label_id = field_id+'_label';
        }else{
          label_id = field_id;
        }
        
        label_id = '#'+label_id;
        console.log(label_id);
        
        $(label_id).append(required_symbol);
        
      }
    });
    
       
}
    
    
    
    
    
    
    