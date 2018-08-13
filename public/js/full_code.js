

function buildTemplate(html,css,js){


	return `<html>

				<head>
				   <meta charset="utf-8"/>
					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
				   <style>
				   			${css}
				   </style>
				</head>

				<body>

					${html}

				<script
				  src="https://code.jquery.com/jquery-3.3.1.min.js"
				  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
				  crossorigin="anonymous"></script>
									<script>
							
						${js}
					</script>
				</body>

				</html>`;
}

function runCode(){



	var html = extractHTML();


	var css = extractCSS();

	var js = extractJS();

	var template = buildTemplate(html,css,js);


	//var target = document.querySelector('#target');


	//Get The Preview Element 

	var previewFrame = document.getElementById('target');

	//Get The document of the iframe 

	var preview  = previewFrame.contentWindow ? previewFrame.contentWindow : previewFrame.contentDocument.document ? previewFrame.contentDocument.document : previewFrame.contentDocument;

	//open the document 

	preview.document.open();


	//inject the code Template 
	preview.document.write(template); 

	

	//close the document 
	preview.document.close();





	 //enjectCode(html,css,js,target); 


}
