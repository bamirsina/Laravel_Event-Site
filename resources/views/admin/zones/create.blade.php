<!-- resources/views/admin/zones/create.blade.php -->

<h1>Create Zones</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="post" action="{{ route('zones.store') }}">
    @csrf

    <div class="form-group">
        <label for="zones">Zones:</label>
        <div class="row" id="zones-container">
            <div class="col">
                <input type="text" name="zones[0][name]" class="form-control" placeholder="Zone Name" required>
            </div>
            <div class="col">
                <input type="number" name="zones[0][price]" class="form-control" placeholder="Zone Price" required min="0">
            </div>
        </div>
        <button type="button" class="btn btn-secondary mt-2" id="add-zone">Add Zone</button>
    </div>

    <button type="submit" class="btn btn-primary">Create Zones</button>
</form>

<script>
    const zonesContainer = document.getElementById('zones-container');
    const addZoneButton = document.getElementById('add-zone');
    let   zoneCounter = 1;

    addZoneButton.addEventListener('click', () => {
        const newZone = `
            <div class="row mt-2">
                <div class="col">
                    <input type="text" name="zones[${zoneCounter}][name]" class="form-control" placeholder="Zone Name" required>
                </div>
                <div class="col">
                    <input type="number" name="zones[${zoneCounter}][price]" class="form-control" placeholder="Zone Price" required min="0">
                </div>
            </div>
        `;
        zonesContainer.insertAdjacentHTML('beforeend', newZone);
        zoneCounter++;
    });
</script>
