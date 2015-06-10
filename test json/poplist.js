$.getJSON('input.json', function()
{
  //first call of function
  $(some_html_element).html( _json.getElements(this) );
};

_json = new function()
{
 this.getElements = function (_element)
 {
  var _sreturn = '<ul><li>';
  $.each(_element, function(val, level) 
  {
   _sreturn += val;

   //every call again, the detph is not care
   _sreturn += ((var childstring = _json.getElements(this)).length > 0) 
                         ? 
                          childstring : '<li>' + level + '</li>';
   });
   return _sreturn + '</ul></li>';
  }
};