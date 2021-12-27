<div class="row">
@foreach ($attributes as $akey => $attribute)
    @php
        $attributeVal = App\Models\Attribute::where('id', $akey)
                ->where('status', 1)
                ->select(['id', 'name'])
                ->first()
                ->toArray();
        $attributeValues = [];
        if(isset($attribute['attributevalues'])){
          $attributeValues = App\Models\AttributeValue::whereIn('id', $attribute['attributevalues'])
                  ->where('status', 1)
                  ->select(['id', 'value'])
                  ->get()
                  ->toArray();
        }
    @endphp
    <div class="form-group col-3">
      <label for="attributeLabel_{{$akey}}">
          {{ $attributeVal['name'] }}
      </label>
      <select
          class="form-control select2"
          name="attributes[{{$akey}}]" id="attributeLabel_{{$akey}}" >
            <option value="">
                  Select {{ $attributeVal['name'] }}
              </option>
          @foreach ($attributeValues as $id => $entry)
              <option value="{{ $entry['id'] }}">
                  {{ $entry['value'] }}
              </option>
          @endforeach
      </select>
  </div>
@endforeach
</div>
