<script>
    $(document).ready(()=>{
        $('#{{ $_SESSION['id'] }}').submit((event)=>{
            event.preventDefault();
              
      	    var form = {
        	    'id_user' : "{{ $_SESSION['id'] }}",
        	    'id_product' : $('input[name=id]').val(),
        	    'id_command' : 0,
        	    'quantity' : 1
      	    }

      	    $.ajax({
        	    type : 'POST',
        	    url : 'tocart',
        	    data : form,
        	    dataType : 'text',
        	    encode : true,
        	    success : (data) => {
          	        console.log(data);
        	    },
        	    error : (data) => {
          	        console.log(data);
        	    }
      	    });
        });
    });
</script>
<script>
    $(document).ready(()=>{
        $("#tri-prix").click(()=>{
            if($('#sdq').hasClass('checked'))
            {
                $('#sdq').load("/articlenon");
                $('#sdq').removeClass("checked");
            }
            else
            {
                $('#sdq').load("/article");
                $('#sdq').addClass("checked");
            }
        });
    });
</script>