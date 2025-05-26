<div class="container my-5">
    <div class="card">
        <div class="card-body">
                <h3>{{ $cours->titre }}</h3>
                <p>{{ $cours->description }}</p>
                @php
                    function getYoutubeEmbedUrl($url) {
                        if (str_contains($url, 'watch?v=')) {
                            return str_replace('watch?v=', 'embed/', $url);
                        } elseif (str_contains($url, 'youtu.be/')) {
                            $id = substr($url, strrpos($url, '/') + 1);
                            return 'https://www.youtube.com/embed/' . $id;
                        }
                        return null;
                    }

                    $embedUrl = isset($contenu->lien) ? getYoutubeEmbedUrl($contenu->lien) : null;
                @endphp

                @if($embedUrl)
                    <div class="ratio ratio-16x9 mb-4">
                        <iframe width="560" height="315" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                @else
                    <p class="text-danger">Aucune vidéo disponible pour ce cours.</p>
                @endif
                <form action="{{ route('cours.quiz', $cours->id) }}" method="POST" class="mt-4">
                    @csrf
                    <label for="reponse">Quel est le mot magique ?</label>
                    <input type="text" name="reponse" class="form-control mb-3" required>

                    <button type="submit" class="btn btn-success">Soumettre</button>
                </form>

                @if(session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @elseif(session('error'))
                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                @endif
        </div>
    </div>
</div>