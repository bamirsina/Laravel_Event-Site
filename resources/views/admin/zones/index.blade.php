<!-- resources/views/zones/index.blade.php -->

<h1>Zones</h1>

<div class="form-group">
    <label for="zone">Select Zone:</label>
    <select name="zone" id="zone" class="form-control">
        @foreach($zones as $zone)
            <option value="{{ $zone->price }}">{{ $zone->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="people">Number of People:</label>
    <input type="number" name="people" id="people" class="form-control">
</div>

<div id="zone-price"></div>
<div id="total-price"></div>

<script>
    const selectElement = document.getElementById('zone');
    const peopleElement = document.getElementById('people');
    const zonePriceElement = document.getElementById('zone-price');
    const totalPriceElement = document.getElementById('total-price');

    selectElement.addEventListener('change', updatePrice);
    peopleElement.addEventListener('input', updatePrice);

    function updatePrice() {
        const selectedPrice = parseFloat(selectElement.value);
        const numOfPeople = parseInt(peopleElement.value, 10);

        const zonePrice = selectedPrice.toFixed(2);
        const totalPrice = (selectedPrice * numOfPeople).toFixed(2);

        zonePriceElement.innerHTML = `Selected Zone Price: ${zonePrice} USD`;
        totalPriceElement.innerHTML = `Total: ${totalPrice} USD`;
    }
</script>
