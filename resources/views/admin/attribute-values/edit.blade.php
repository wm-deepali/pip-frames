<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="attribute-value-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Edit Attribute Value</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        {{-- Attribute (readonly) --}}
        <div class="form-group">
          <label>Attribute <span class="text-danger">*</span></label>
          <select class="form-control" disabled id="attribute-select">
            <option value="{{ $attribute->id }}" selected>{{ $attribute->name }}</option>
          </select>
          <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
          <span class="text-danger validation-err" id="attribute_id-err"></span>
        </div>

        {{-- Title --}}
        <div class="form-group" id="title-wrapper" style="display: none;">
          <label>Title <span class="text-danger">*</span></label>
          <input type="text" name="title" class="form-control" value="{{ $attributeValue->title }}">
          <span class="text-danger validation-err" id="title-err"></span>
        </div>

        @php
          $inputType = $attributeConfigs[$attribute->id]['input_type'] ?? 'text';
          $requireBothImages = $attributeConfigs[$attribute->id]['require_both_images'] ?? false;
        @endphp

        <div class="form-group" id="value-wrapper">
          <label>Value <span class="text-danger">*</span></label>

          @if ($inputType === 'select_image' && $requireBothImages)
            <label>Portrait Image (optional)</label>
            <input type="file" name="image_portrait" class="form-control-file mb-2">
            @if (!empty($attributeValue->image_portrait_path))
              <div class="mt-2">
                <strong>Existing Portrait Image:</strong><br>
                <img src="{{ asset('storage/' . $attributeValue->image_portrait_path) }}" width="80" alt="Portrait Image">
              </div>
            @endif

            <label>Landscape Image (optional)</label>
            <input type="file" name="image_landscape" class="form-control-file">
            @if (!empty($attributeValue->image_landscape_path))
              <div class="mt-2">
                <strong>Existing Landscape Image:</strong><br>
                <img src="{{ asset('storage/' . $attributeValue->image_landscape_path) }}" width="80" alt="Landscape Image">
              </div>
            @endif

          @elseif (in_array($inputType, ['select_image', 'select_icon']))
            <input type="file" name="value" class="form-control-file">
            @if ($attributeValue->image_path)
              <div class="mt-2 existing-preview">
                <strong>Existing Image:</strong><br>
                <img src="{{ asset('storage/' . $attributeValue->image_path) }}" width="80" alt="Current Image">
              </div>
            @endif
          @else
            <input type="text" name="value" class="form-control" value="{{ $attributeValue->value }}">
          @endif

          <span class="text-danger validation-err" id="value-err"></span>
        </div>

        {{-- Value --}}


        {{-- Icon Class --}}
        @if ($attribute->has_icon)
          <div class="form-group" id="icon-class-wrapper">
            <label>Icon Class</label>
            <input type="text" name="icon_class" class="form-control" value="{{ $attributeValue->icon_class }}">
            <span class="text-danger validation-err" id="icon_class-err"></span>
          </div>
        @endif

        {{-- Optional Image Field --}}
        @if ($attribute->has_image)
          <div class="form-group" id="image-wrapper">
            <label>Image (optional)</label>
            <input type="file" name="image" class="form-control-file">
            @if ($attributeValue->image_path)
              <div class="mt-2">
                <img src="{{ asset('storage/' . $attributeValue->image_path) }}" width="60">
              </div>
            @endif
            <span class="text-danger validation-err" id="image-err"></span>
          </div>
        @endif

        @if (!is_null($attribute->custom_input_type) && $attribute->custom_input_type !== 'none')
          <div class="form-group" id="custom-input-label-wrapper">
            <label>Custom Input Label</label>
            <input type="text" name="custom_input_label" class="form-control"
              value="{{ $attributeValue->custom_input_label }}">
            <span class="text-danger validation-err" id="custom_input_label-err"></span>
          </div>
        @endif

        @if ($attribute->is_composite)
          {{-- Show checkbox only if attribute supports composite values --}}

          <div class="form-group mb-2" id="is-composite-wrapper">
            <label for="is_composite_value">Is Composite Value?</label>
            <select class="form-control" name="is_composite_value" id="is_composite_value">
              <option value="0" {{ !$attributeValue->is_composite_value ? 'selected' : '' }}>No</option>
              <option value="1" {{ $attributeValue->is_composite_value ? 'selected' : '' }}>Yes</option>
            </select>
          </div>


          {{-- Composed Of Select --}}
          <div class="form-group {{ $attributeValue->is_composite_value ? '' : 'd-none' }}" id="composed-of-wrapper">
            <label>Select Composed Of Values</label>
            <div id="composed-of-select-wrapper">
              @forelse ($availableValues as $val)
                @continue($val->id == $attributeValue->id)
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="composed_of[]" value="{{ $val->id }}"
                    id="composed_of_{{ $val->id }}" {{ in_array($val->id, $attributeValue->composed_of_array ?? []) ? 'checked' : '' }}>
                  <label class="form-check-label" for="composed_of_{{ $val->id }}">
                    {{ $val->value }}
                  </label>
                </div>
              @empty
                <p class="text-muted">No values available to compose.</p>
              @endforelse
            </div>
          </div>
        @endif

        {{-- Colour Fields --}}
        @if ($inputType === 'select_colour')
          <div class="form-group" id="colour-fields-wrapper">
            <label>Colour Code</label>
            <input type="text" name="colour_code" class="form-control colour-code-input"
              value="{{ $attributeValue->colour_code ?? '' }}" placeholder="#FF0000">

            <label class="mt-2">Select Colour</label>
            <input type="color" name="colour_picker" class="form-control form-control-color colour-picker-input"
              value="{{ $attributeValue->colour_code ?? '#ffffff' }}" style="width: 60px; height: 38px; padding: 2px;">

            <label class="mt-2">Preview</label>
            <div class="colour-preview border rounded"
              style="width: 60px; height: 38px; background: {{ $attributeValue->colour_code ?? '#ffffff' }}">
            </div>
          </div>
        @endif


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="update-attribute-value-btn"
          data-id="{{ $attributeValue->id }}">
          Update
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function () {
    const inputType = @json($attributeConfigs[$attribute->id]['input_type'] ?? 'text');

    // --- Composite toggle ---
    function toggleComposedWrapper() {
      const isComposite = $('#is_composite_value').val() === '1';
      $('#composed-of-wrapper').toggleClass('d-none', !isComposite);
      $('#composed-of-select-wrapper input[type="checkbox"]').prop('disabled', !isComposite);
    }
    $('#is_composite_value').on('change', toggleComposedWrapper);
    toggleComposedWrapper();

    // --- Value wrapper visibility ---
    if (inputType === 'select_area') {
      $('#value-wrapper').addClass('d-none');
    } else {
      $('#value-wrapper').removeClass('d-none');
    }

    // --- Title field visibility ---
    if (['select_image', 'select_icon'].includes(inputType)) {
      $('#title-wrapper').show();
    } else {
      $('#title-wrapper').hide();
    }

    // --- Hide existing preview on new file selection ---
    $('input[name="value"]').on('change', function () {
      $(this).siblings('.existing-preview').hide();
    });

    // --- Colour picker sync (only if colour input type) ---
    if (inputType === 'select_colour') {
      const $codeInput = $('.colour-code-input');
      const $picker = $('.colour-picker-input');
      const $preview = $('.colour-preview');

      // Code -> Picker + Preview
      $codeInput.on('input', function () {
        const val = $(this).val().trim();
        if (/^#([0-9A-F]{3}){1,2}$/i.test(val)) {
          $picker.val(val);
          $preview.css('background', val);
        }
      });

      // Picker -> Code + Preview
      $picker.on('input', function () {
        const val = $(this).val();
        $codeInput.val(val);
        $preview.css('background', val);
      });
    }
  });
</script>