function test() {
	alert('This is just a test!');
}

function addRow(e) {
   var $table = $('#milestone-grid table tbody');
   $('.add-row').click(function(e) {
	 //If it is odd then the next one should be even.. 
	 var number = (($table.find('tr').size())%2 === 0)?'odd':'even';
	 var html = '<tr class="'+number+'"> <td>Added</td> </tr>';
	 $table.append(html);
	 return false;
   });   
}