<!DOCTYPE html>
<html>
<head>
    <title>Added Sugar Repository</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		 body {
			font-family: 'Roboto', sans-serif !important;
			font-family: 'Open Sans', sans-serif !important;
		}
	</style>
</head>
<body>
    <div class="container">
        <div class="table-responsive">
            <br />
            <br />
            <div id="asr_table">
            </div>
        </div>
    </div>
</body>
</html>

<script>
    $(document).ready(function () {
        $.ajax({
            url: "asr.csv",
            dataType: "text",
            success: function (data)
            {
                var asr_data = data.split(/\r?\n|\r/);
                var table_data = '<table class="table table-bordered table-striped">';
                var asrName = findName(asr_data[0], "Name of Added Sugar");
				var productName = findName(asr_data[0], "Product Name");
				var urlName = findName(asr_data[0], "URL");
                for (var count = 0; count < asr_data.length; count++) {
                    var cell_data = asr_data[count].split(";");
                    table_data += '<tr>';
                    for (var cell_count = 0; cell_count < cell_data.length; cell_count++) {
                        if (count === 0 && (cell_count === 0 || cell_count === asrName || cell_count === productName)) {
                            table_data += '<th>' + cell_data[cell_count] + '</th>';
                        }
                        else {
                            if (cell_count == productName) {
								let localURL=cell_data[urlName];
								console.log(cell_data[urlName]);
								if(trailingSlashCheck(localURL)){
								console.log(cell_data[urlName]);
									localURL=trailingSlashRemover(cell_data[urlName]);
									console.log(localURL);
								}
                                table_data += '<td>' + `<a href=${localURL}>` + '<div>' + cell_data[productName] + '</div>' + '</a>' + '</td>';
                            }
                            else if ((cell_count === 0 || cell_count === asrName)) {
                                table_data += '<td>' + cell_data[cell_count] + '</td>';
                            }
                        }
                    }
                    table_data += '</tr>';

                }
                table_data += '</table>';
                $('#asr_table').html(table_data);
            }
        });
    });

    function findName(input, name) {
        var localarr=input.split(";");
		for(var i=0;i<localarr.length;i++){
			if(localarr[i]===name) 
			return i;
		}
    }

	function trailingSlashCheck(input){
		let splitIn = input.split('');
		let total=splitIn.length;
		if(splitIn[total-1]=='/'){
			return true;
		}
		else return false;
		
	}

	function trailingSlashRemover(input){
		let splitIn = input.split('');
		let out;
		splitIn.pop();
		out=splitIn.join("");
		return out;
	}

	function blankCell(){
		return false;
		return true;

	}
</script>