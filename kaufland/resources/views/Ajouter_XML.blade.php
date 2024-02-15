@extends('Layouts.template')

@section('title')
Dorra dhahri
@endsection
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


@section('content')

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Add XML</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('acceuil')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add XML </li>
								</ol>
							</nav>
						</div>
					
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					
					

				<form action="{{ route('importXml')}}" method="POST" id="form">
    @csrf 
    <h5>Information </h5>
    <br>
    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>XML file</label>
                    <br>
                    <input type="file" name="xmlFile" id="xmlFile" accept=".xml" onchange="lireFichierXML()">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Data Source name</label>
                    <input type="text" class="form-control" name="Source" required>
                </div>
            </div>
        </div>
    </section>
    <center>
        <button type="button" class="fc-month-button btn btn-primary active" onclick="envoyerDonneesAuServeur()">Add</button>
    </center>
</form>

<script>
    let xmlContent = null;

    function lireFichierXML() {
        const input = document.getElementById('xmlFile');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                xmlContent = e.target.result;
                console.log("Contenu du fichier XML :", xmlContent);
            };

            reader.readAsText(file);
        }
    }

    function envoyerDonneesAuServeur() {
        if (xmlContent) {
            axios.post('{{ route("importXml") }}', { xmlContent: xmlContent, Source: document.getElementsByName('Source')[0].value })
                .then(response => {
                    console.log(response.data);
                    alert('Données insérées avec succès.');
                })
                .catch(error => {
                    console.error(error);
                    alert('Erreur lors de l\'insertion des données.');
                });
        } else {
            alert('Aucun fichier XML sélectionné.');
        }
    }
</script>
					
				</div>

			

			</div>
		</div></div>

	
			@endsection
