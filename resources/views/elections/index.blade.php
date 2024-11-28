<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/css/custom.css')
    <title>Elecciones Estudiantiles</title>
    <link rel="shortcut icon" href="https://th.bing.com/th/id/OIP.3QIB-x7FollcN1lT2gxTIAHaI7?rs=1&pid=ImgDetMain">   

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<div class="mb-24">
    @include('page.navbar')
</div>
<body class="bg-[#e9e0cb] text-[#3D5873] font-poppins h-40 flex flex-col">
    <header class="py-4">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center text-[#3D5873]">
                Elecciones Estudiantiles 2024
            </h1>
        </div>
    </header>

    <main class="flex-grow">
        <div class="container mx-auto px-4 py-8">
            <!-- Validación del DNI -->
            <div id="dni-validation" class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-center mb-4 text-black">Validar Participación</h2>
                <input
                    type="text"
                    id="dni-input"
                    placeholder="Ingrese su DNI"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#E03E41]"
                >
                <button
                    onclick="validateDNI()"
                    class="mt-4 w-full bg-[#3D5873] text-white py-3 rounded-lg hover:bg-[#2c4359] transition duration-300"
                >
                    Validar DNI
                </button>
                <div id="student-info" class="mt-4 hidden bg-[#F0C43E] text-[#3D5873] p-4 rounded-lg">
                    <p class="text-lg font-medium"><strong>Nombre:</strong> <span id="student-name"></span></p>
                    <p class="text-lg font-medium"><strong>Aula:</strong> <span id="student-classroom"></span></p>
                </div>
            </div>

            <!-- Lista de Candidatos -->
            <div id="candidates" class="mt-10 hidden">
                <h2 class="text-xl font-semibold text-center mb-6 text-[#E03E41]">Elige tu Candidato</h2>
                <div id="candidates-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
                <button
                    onclick="submitVote()"
                    class="mt-6 w-full bg-[#E03E41] text-white py-3 rounded-lg hover:bg-red-600 transition duration-300 font-semibold"
                >
                    Enviar Voto
                </button>
            </div>
        </div>
    </main>

    <footer class="bg-[#3D5873] text-white py-6 mt-36">
        <div class="container mx-auto text-center text-sm">
            &copy; 2024 Elecciones Estudiantiles - Colegio
        </div>
    </footer>

    <script>
        let selectedStudentId = null;
        let selectedCandidateId = null;

        function validateDNI() {
            const dni = document.getElementById('dni-input').value;

            axios.post('/elecciones/validar', { dni })
                .then(response => {
                    const student = response.data.student;
                    selectedStudentId = student.id;

                    document.getElementById('student-name').textContent = 
                        `${student.nombres} ${student.apellido_paterno} ${student.apellido_materno}`;
                    document.getElementById('student-classroom').textContent = student.classroom;

                    document.getElementById('student-info').classList.remove('hidden');
                    loadCandidates();
                })
                .catch(error => {
                    console.error('Error completo:', error.response);
                    alert(error.response ? error.response.data.message : 'Error desconocido');
                });
        }

        function loadCandidates() {
            axios.get('/elecciones/candidatos')
                .then(response => {
                    const candidatesList = document.getElementById('candidates-list');
                    candidatesList.innerHTML = '';
            
            // Agregar tarjeta de voto en blanco
            const blankVoteCard = document.createElement('div');
            blankVoteCard.className = 
                'bg-white border border-gray-300 rounded-lg shadow hover:shadow-lg transition p-4 text-center cursor-pointer';
            
                blankVoteCard.innerHTML = `
                    <img src="./img/blank-vote-image.jpg" alt="Voto en Blanco" class="rounded-lg w-full mb-4">
                    <h3 class="font-semibold text-[#3D5873]">Voto en Blanco</h3>
                `;

            
            blankVoteCard.onclick = () => selectCandidate(null); // Null para voto en blanco
            candidatesList.appendChild(blankVoteCard);

            // Resto del código para cargar candidatos normales
            if (response.data && response.data.candidates) {
                response.data.candidates.forEach(candidate => {
                    const candidateCard = document.createElement('div');
                    candidateCard.className = 
                        'bg-white border border-gray-300 rounded-lg shadow hover:shadow-lg transition p-4 text-center cursor-pointer';
                    
                    candidateCard.innerHTML = `
                        <img src="${candidate.simbolo}" alt="${candidate.nombre}" class="rounded-lg w-full mb-4">
                        <h3 class="font-semibold text-[#3D5873]">${candidate.nombre}</h3>
                    `;
                    
                    candidateCard.onclick = () => selectCandidate(candidate.id);
                    candidatesList.appendChild(candidateCard);
                });
            }
            
            document.getElementById('candidates').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error loading candidates:', error);
            alert(error.response?.data?.message || 'Error al cargar candidatos');
        });
}

        function selectCandidate(candidateId) {
            selectedCandidateId = candidateId;
            document.querySelectorAll('#candidates-list > div').forEach(el => {
                el.classList.remove('border-[#E03E41]', 'ring-2', 'ring-[#E03E41]');
            });
            event.currentTarget.classList.add('border-[#E03E41]', 'ring-2', 'ring-[#E03E41]');
        }

        function submitVote() {
    if (!selectedStudentId) {
        alert('Por favor, valide su DNI');
        return;
    }

    const voteData = {
        student_id: selectedStudentId,
        candidate_id: selectedCandidateId, // Null para voto en blanco
        is_blank_vote: selectedCandidateId === null
    };

    axios.post('/elecciones/votar', voteData)
    .then(response => {
        alert('Voto registrado exitosamente');
        location.reload();
    })
    .catch(error => {
        alert(error.response.data.message);
    });
}
    </script>
</body>
</html>
