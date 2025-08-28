<style>
    @media only screen and (max-width: 499px) {
        .container {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
    }
</style>



<!-- Start Main Slider -->
<section class="maintop-banner style1">
    <div class="container">


        <div class="row align-items-start mobile-responsive">
            <!-- Left Part -->
            <div class="col-12 col-lg-6 left-part">
                <h2 class="mobile-heading">Select Category</h2>
                <div class="options cards mb-5">
                    @foreach($subcategories as $subcategory)
                        <div>
                            <div class="option-card1 {{ $loop->first ? 'active' : '' }}" data-id="{{ $subcategory->id }}"
                                data-name="{{$subcategory->name }}" onclick="selectSubcategory(this)">
                                <img src="{{ asset('storage/' . ($subcategory->thumbnail ?? '')) }}"
                                    alt="{{ $subcategory->name ?? ''}}">

                            </div>
                            <p class="text-center">{{ $subcategory->name ?? ''}}</p>
                        </div>
                    @endforeach
                </div>
                <h2 id="selected-subcategory-name" class="mobile-heading">{{ $subcategories->first()->name ?? '' }}
                    Portrait</h2>

                <p class="offer">
                    <span class="old-price">£71.94</span>
                    <span class="new-price">£59.95</span>
                    <span class="discount">SAVE 16%</span>
                </p>
                <ul class="features">
                    <li>✔ Made and shipped from the UK</li>
                    <li>✔ Average 2-4 working days delivery time</li>
                    <li>✔ Artwork proof within 24 hours</li>
                </ul>

                <!-- Stepper -->
                <div class="stepper mb-5" id="stepper">
                    <span class="step active" onclick="goToStep(1)">1</span>
                    <span class="line"></span>
                    <span class="step" onclick="goToStep(2)">2</span>
                    <span class="line"></span>
                    <span class="step" onclick="goToStep(3)">3</span>
                    <span class="line"></span>
                    <span class="step" onclick="goToStep(4)">4</span>
                    <span class="line"></span>
                    <span class="step" onclick="goToStep(5)">5</span>
                </div>

                <!-- Step Content -->
                <div class="step-content">
                    <!-- STEP 1,2,3 -->
                    <div class="step-box" id="step-1"></div>
                    <div class="step-box" id="step-2" style="display:none;"></div>
                    <div class="step-box" id="step-3" style="display:none;"></div>
                    <!-- STEP 4 -->
                    <div class="step-box" id="step-4" style="display:none;">

                        <!-- Upload photo -->
                        <h4 class="mb-2">Upload a picture</h4>
                        <a href="#" class="tips-link">📷 Click here for photo tips</a>


                        <div id="upload-block"></div>

                        <!-- Container to show image previews -->
                        <div id="preview-container" style="margin-top:10px; display:flex; flex-wrap:wrap; gap:10px;">
                        </div>

                        <!-- Unable to upload -->
                        <div class="upload-help">
                            <input type="checkbox" id="no-upload">
                            <label for="no-upload">Are you unable to upload a photo? <a href="#">More info</a></label>
                        </div>

                        <!-- Form fields -->
                        <div class="form-fields">
                            <input id="petNameInput" type="text" placeholder="Enter the names (if required)">
                            <!-- <input id="petBirthdateInput" type="text" placeholder="Birthdate - optional"> -->
                            <input id="petTextInput" type="text" placeholder="Personal text - optional">
                            <textarea id="noteInput"
                                placeholder="Note to artist - optional (e.g. Draw a bow tie, remove collar...)"></textarea>
                        </div>

                        <!-- Navigation -->
                        <div class="step-nav">
                            <button class="prev-btn" onclick="goToStep(3)">← Previous step</button>
                            <button class="next-btn" onclick="nextStep()">Next step →</button>
                        </div>
                    </div>


                    <!-- STEP 5 -->
                    <div class="step-box" id="step-5" style="display:none; width:90%;">
                        <h3 class="mb-3" style="font-size:1.6rem; margin-bottom:18px; font-weight:bold;">Extra options
                        </h3>

                        <div style="margin-bottom:36px;">
                            @foreach ($extraOptions as $option)
                                <label style="display:flex; align-items:flex-start; cursor:pointer; margin-bottom:12px;">
                                    <input type="checkbox" name="extra_options[]" value="{{ $option->id }}"
                                        data-price="{{ $option->price }}"
                                        style="accent-color:#ff3b7c; width:20px; height:20px; margin-right:8px; margin-top:2px;">
                                    <div>
                                        <span style="font-weight:bold;">
                                            {{ $option->title }} &nbsp; + &nbsp; £{{ number_format($option->price, 2) }}
                                        </span>
                                        <div style="color: #888; font-size: 0.9rem;">
                                            {{ $option->description }}
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>


                        <div style="font-size:1.3rem; text-align:right; margin-bottom:36px;">
                            <b>Subtotal:</b> <span id="subtotal-amount"
                                style="font-weight:bold; font-size:1.25em;">£0.00</span>
                        </div>

                        <div style="display:flex; flex-direction: column;
    gap: 24px;
    align-items: center;">
                            <button class="prev-btn" type="button" onclick="goToStep(4)"
                                style="flex:1; background:#fff; border:2px solid #ff3b7c; color:#ff3b7c; font-weight:bold; font-size:1.1rem; border-radius:30px; padding:13px 0; box-shadow:0 1px 8px rgba(0,0,0,0.07); cursor:pointer;">
                                Previous step
                            </button>
                            <button class="next-btn" type="button"
                                style="flex:2; background:#ff3b7c; color:#fff; font-weight:bold; font-size:1.13rem; border-radius:30px; border:none; padding:13px 0; box-shadow:0 1px 8px rgba(0,0,0,0.07); cursor:pointer;"
                                onclick="addToCart()">
                                Add to cart →
                            </button>
                        </div>
                        <div style="text-align:center; margin-top:30px;">
                            <div style="font-size:1.15rem; color:#ff3b7c; margin-bottom:5px; font-weight:500;">
                                Or
                            </div>
                            <a href="/design-portrait"
                                style="display:inline-block; text-decoration:underline; color:#ff3b7c; font-size:1.1rem; font-weight:500; margin-bottom:3px;">
                                <span id="designSecondPortrait"
                                    style="margin-right:6px; font-size:1.2em;">✏️</span>Design a 2nd portrait
                            </a>
                            <div style="color:#848484; font-size:1rem; margin-top:3px; font-style:italic;">
                                and receive 10% extra discount on your order!
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Right Part -->
            <div class="col-12 col-lg-6 right-part text-center">
                <!-- <div class="preview">
                    <img src="{{ asset('storage/' . ($subcategories->first()->thumbnail ?? '')) }}" alt="Pet Portrait"
                        class="preview-img" id="main-img">

                </div> -->
                <!-- Portrait preview -->
                <div id="portraitPreview" class="preview active">
                    <img id="mainImagePortrait" class="preview-img"
                        src="{{ asset('storage/' . ($subcategories->first()->thumbnail ?? '')) }}"
                        alt="Pet Portrait Portrait" />
                    <!-- Frame overlay for portrait -->
                    <img id="frameOverlayPortrait" class="frame-overlay" />
                </div>

                <!-- Landscape preview -->
                <div id="landscapePreview" class="preview-container"
                    style="position: relative; display: none;     margin-top: -17px;">
                    <img id="mainImageLandscape" class="preview-img-landscape" src="" alt="Pet Portrait Landscape" />
                    <!-- Frame overlay for landscape -->
                    <img id="frameOverlayLandscape" class="frame-overlay-landscape" />
                </div>


                <!-- Thumbnails -->
                <div class="thumbnails" id="thumbnails-container">
                    @if ($subcategories->first()->gallery)
                        @foreach ($subcategories->first()->gallery as $image)
                            <img src="{{ asset('storage/' . $image) }}" onclick="changeImage(this)" alt="Thumbnail" />
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>

</section>

<!-- Modal structure -->
<div id="infoModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
    background: rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:1000;">
    <div
        style="background:#fff; padding:20px; border-radius:6px; max-width:400px; text-align:center; position:relative;">
        <h3>Important Information</h3>
        <p>If you are unable to upload a photo, or if you have doubts about which photo is suitable, you can place
            the order without a photo. We will email you to help choose the right photo for your order!</p>
        <button id="closeModalBtn" style="margin-top:15px; padding:8px 15px; cursor:pointer;">Close</button>
    </div>
</div>

<div id="tipModal" class="modal"
    style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.45); justify-content:center; align-items:center; z-index:10000;">
    <div
        style="background:#fff; padding:32px 24px; border-radius:14px; max-width:650px; width:90%; min-width:260px; font-family:sans-serif; box-shadow:0 6px 40px rgba(0,0,0,0.13); position:relative;">
        <h2 style="margin-bottom:18px; font-size:2.1rem;">Image guidelines</h2>
        <div style="display:flex; flex-direction:column; gap:20px;">
            <div style="display:flex; gap:15px;">
                <span style="font-size:1.5rem; color:#388e3c;">✔</span>
                <div>
                    <div style="font-weight:bold; font-size:1.08rem;">TIP 1 - GOOD LIGHTNING</div>
                    <div>Good light is the most important thing. Take a photo in daylight or in a well-lit room. Our
                        artists work with the colours of the photo, so make sure you capture your pet in good light and
                        that you are happy with the colours in the photo.</div>
                </div>
            </div>
            <div style="display:flex; gap:15px;">
                <span style="font-size:1.5rem; color:#388e3c;">✔</span>
                <div>
                    <div style="font-weight:bold; font-size:1.08rem;">TIP 2 - A GOOD POSE</div>
                    <div>The sharper the better. Try to get a close-up of your pet. Sitting and standing photos work
                        best! If your pet is lying down, it is more difficult to create a beautiful work of art. A
                        picture taken right in front of your pet works best.</div>
                </div>
            </div>
            <div style="display:flex; gap:15px;">
                <span style="font-size:1.5rem; color:#388e3c;">✔</span>
                <div>
                    <div style="font-weight:bold; font-size:1.08rem;">TIP 3 - UPLOAD SEPARATE IMAGES</div>
                    <div>If you want to have 2 pets in 1 portrait, it is best to upload 2 individual photos of them. Are
                        they inseparable and do you only have a photo of them together? Then that's still possible too!
                        You don't have to upload an extra photo.</div>
                </div>
            </div>
            <div style="display:flex; gap:15px;">
                <span style="font-size:1.5rem; color:#388e3c;">✔</span>
                <div>
                    <div style="font-weight:bold; font-size:1.08rem;">TIP 4 - KEEP EVERYTHING IN THE PICTURE</div>
                    <div>Our artists can only draw what they see in the picture, so make sure you capture everything
                        that needs to be drawn. So keep the ears within the frame of the photo, for example!</div>
                </div>
            </div>
            <div style="display:flex; gap:15px;">
                <span style="font-size:1.5rem; color:#388e3c;">✔</span>
                <div>
                    <div style="font-weight:bold; font-size:1.08rem;">TIP 5 - NO OTHER ANIMALS ON THE PHOTO</div>
                    <div>It is best if there are no other animals in the picture of your pet. This way our illustrator
                        always knows which animal to draw.</div>
                </div>
            </div>
        </div>
        <button id="tipModalClose"
            style="margin-top:24px; padding:10px 22px; background:#ff3b7c; color:#fff; border:none; border-radius:6px; font-weight:bold; font-size:1rem; cursor:pointer;">Close</button>
    </div>
</div>

<script>
    const subcategoryGalleries = @json($subcategories->mapWithKeys(function ($subcategory) {
        return [$subcategory->id => $subcategory->gallery ?? []];
    }));

    const subcategoryThumbnails = @json($subcategories->mapWithKeys(function ($subcategory) {
        return [$subcategory->id => $subcategory->thumbnail ?? ''];
    }));
</script>

<script>
    // Global state
    let currentSelections = {};
    let attributeConditions = [];
    const totalSteps = 5;
    let currentCategoryId = null;
    let currentStep = 1;
    let imageConditions = [];
    let groupedImageConditions = [];

    // Show specified step and update UI and URL hash
    function showStep(step) {
        document.querySelectorAll(".step-box").forEach(box => box.style.display = "none");
        const stepBox = document.getElementById(`step-${step}`);
        if (stepBox) stepBox.style.display = "block";

        document.querySelectorAll(".step").forEach((el, idx) => {
            el.classList.toggle("active", (idx + 1) === step);
        });

        currentStep = step;
        history.replaceState(null, null, `#step=${step}`);
    }

    // Check if step is empty
    function isStepEmpty(step) {
        if (step === 4 || step === 5) return false;
        const container = document.getElementById(`step-${step}`);
        if (!container) return true;
        return !Array.from(container.querySelectorAll('.attribute-block'))
            .some(el => el.style.display !== 'none');
    }

    // Go to a step, skipping empty steps
    function goToStep(step) {
        if (step < 1) step = 1;
        if (step > totalSteps) step = totalSteps;

        if (step > currentStep) {
            // Moving forward: skip empty steps going forward
            while (step <= totalSteps && isStepEmpty(step)) {
                step++;
            }
            if (step > totalSteps) step = totalSteps;
        } else if (step < currentStep) {
            // Moving backward: skip empty steps going backward
            while (step >= 1 && isStepEmpty(step)) {
                step--;
            }
            if (step < 1) step = 1;
        }

        showStep(step);
    }

    function nextStep() {
        let nextStep = currentStep + 1;
        while (nextStep <= totalSteps && isStepEmpty(nextStep)) {
            nextStep++;
        }
        if (nextStep > totalSteps) {
            alert("All steps completed");
            return;
        }
        goToStep(nextStep);
    }

    function previous() {
        let prevStep = currentStep - 1;
        while (prevStep >= 1 && isStepEmpty(prevStep)) {
            prevStep--;
        }
        if (prevStep < 1) prevStep = 1;
        goToStep(prevStep);
    }


    function updateUploadInputs(requiredCount) {

        const uploadBlockContainer = document.getElementById('upload-block');
        const previewContainer = document.getElementById('preview-container');

        // Remove existing upload-box elements, except for the original add-photo button
        uploadBlockContainer.querySelectorAll('.upload-box').forEach(el => el.remove());
        previewContainer.innerHTML = ''; // Clear existing previews

        for (let i = 0; i < requiredCount; i++) {
            const uploadDiv = document.createElement('div');
            uploadDiv.classList.add('upload-box');
            uploadDiv.style.marginTop = '10px';

            const label = document.createElement('label');
            label.className = 'upload-btn';
            label.innerHTML = '<b>Choose a photo</b>';
            label.style.cursor = 'pointer';

            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'photos[]';
            input.accept = 'image/*';
            input.hidden = true;

            // Unique id for preview
            const fileId = 'file-input-' + i;
            input.dataset.fileId = fileId;

            const fileNameSpan = document.createElement('span');
            fileNameSpan.className = 'file-name';
            fileNameSpan.style.marginLeft = '10px';
            fileNameSpan.style.fontSize = '0.9em';

            label.appendChild(input);
            uploadDiv.appendChild(label);
            uploadDiv.appendChild(fileNameSpan);

            uploadBlockContainer.appendChild(uploadDiv);

            // File input change event handling...
            input.addEventListener('change', () => {
                if (input.files && input.files[0]) {
                    fileNameSpan.textContent = input.files[0].name;

                    // Remove old preview if exists
                    const existingPreview = previewContainer.querySelector(`img[data-file-id="${fileId}"]`);
                    if (existingPreview) previewContainer.removeChild(existingPreview);

                    // Create new preview
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.dataset.fileId = fileId;
                        img.style.height = '80px';
                        img.style.border = '1px solid #ccc';
                        img.style.borderRadius = '4px';
                        img.style.objectFit = 'cover';
                        img.style.marginRight = '8px';
                        img.style.marginTop = '8px';
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    fileNameSpan.textContent = '';
                    const existingPreview = previewContainer.querySelector(`img[data-file-id="${fileId}"]`);
                    if (existingPreview) previewContainer.removeChild(existingPreview);
                }
            });

            label.addEventListener('click', () => input.click());
        }
    }


    // function goToStep(step) {
    //     if (step < 1) step = 1;
    //     if (step > totalSteps) step = totalSteps;

    //     if (step > currentStep) {
    //         // Moving forward: skip empty steps going forward
    //         while (step <= totalSteps && isStepEmpty(step)) {
    //             step++;
    //         }
    //         if (step > totalSteps) step = totalSteps;
    //     } else if (step < currentStep) {
    //         // Moving backward: skip empty steps going backward
    //         while (step >= 1 && isStepEmpty(step)) {
    //             step--;
    //         }
    //         if (step < 1) step = 1;
    //     }
    //     showStep(step);
    // }

    // Advance to next step
    // function nextStep() {
    //     let next = currentStep + 1;
    //     while (next <= totalSteps && isStepEmpty(next)) {
    //         next++;
    //     }
    //     if (next > totalSteps) {
    //         alert('All steps completed!');
    //     } else {
    //         goToStep(next);
    //     }
    // }

    // Change main preview image on thumbnail click
    function changeImage(img) {
        const mainImg = document.getElementById("main-img");
        if (mainImg) mainImg.src = img.src;
    }

    // Render attributes for a given step
    function renderStep(stepNumber, attributes) {
        const container = document.getElementById(`step-${stepNumber}`);
        if (!container) return;

        container.innerHTML = "";
        let parentSelectionsToProcess = [];
        attributes.forEach(attr => {
            const attrWrapper = document.createElement("div");
            attrWrapper.className = "attribute-block";
            attrWrapper.dataset.attributeId = attr.id;

            const title = document.createElement("h4");
            title.className = "mb-3";
            title.textContent = attr.name + (attr.is_required ? " *" : "");
            attrWrapper.appendChild(title);

            if (attr.input_type === "select_image") {
                const optionsDiv = document.createElement("div");
                optionsDiv.className = "options cards";
                attr.values.forEach((val, idx) => {
                    const optionCard = document.createElement("div");
                    optionCard.className = "option-card";
                    optionCard.dataset.valueId = val.id;

                    // Only auto-select for steps other than 3
                    if (currentSelections[attr.id] === val.id) {
                        optionCard.classList.add("active");
                        parentSelectionsToProcess.push({ attrId: attr.id, valId: val.id });
                    } else if (currentSelections[attr.id] === undefined && idx === 0) {

                        optionCard.classList.add("active");
                        currentSelections[attr.id] = val.id;
                        parentSelectionsToProcess.push({ attrId: attr.id, valId: val.id });
                        if (attr.required_file_uploads && val.required_file_uploads && val.required_file_uploads > 0) {
                            updateUploadInputs(val.required_file_uploads);
                        }
                    }

                    if (stepNumber === 3 && attr.name.toLowerCase() === 'how do you want it framed?') {
                        const firstVal = attr.values[0]; // the first option

                        // Set localStorage keys for the frame
                        if (firstVal.value.toLowerCase() === 'no frame' || firstVal.value === undefined) {
                            localStorage.removeItem(`selectedFramePortrait_${currentSelections.categoryId || currentCategoryId}`);
                            localStorage.removeItem(`selectedFrameLandscape_${currentSelections.categoryId || currentCategoryId}`);
                        } else {
                            if (firstVal.image_portrait_path) {
                                localStorage.setItem(`selectedFramePortrait_${currentSelections.categoryId || currentCategoryId}`, `/storage/${firstVal.image_portrait_path}`);
                            }
                            if (firstVal.image_landscape_path) {
                                localStorage.setItem(`selectedFrameLandscape_${currentSelections.categoryId || currentCategoryId}`, `/storage/${firstVal.image_landscape_path}`);
                            }
                        }

                        // Update preview image to reflect frame change
                        updateMainImage();
                    }


                    // Determine image source preferentially: portrait first, then landscape, then fallback image_path
                    const imgSrc = (attr.require_both_images)
                        ? (val.image_portrait_path
                            ? `/storage/${val.image_portrait_path}`
                            : (val.image_landscape_path
                                ? `/storage/${val.image_landscape_path}`
                                : ''))  // No fallback to image_path when require_both_images is true
                        : (val.image_path ? `/storage/${val.image_path}` : '');

                    optionCard.innerHTML = `
                    <div class="option-card-attribue">
                    <div class="attribute-background-image">
    <img src="${imgSrc}" alt="${val.value}">
    </div>
    <p>${val.value}</p>
    </div>
`;


                    optionCard.onclick = () => {
                        optionsDiv.querySelectorAll(".option-card").forEach(card => card.classList.remove("active"));
                        optionCard.classList.add("active");
                        currentSelections[attr.id] = val.id;
                        updateDependentAttributeImages(attr.id, val.id);
                        if (attr.required_file_uploads && val.required_file_uploads && val.required_file_uploads > 0) {
                            updateUploadInputs(val.required_file_uploads);
                        }

                        if (stepNumber === 3 && attr.name.toLowerCase() === 'how do you want it framed?') {

                            // Check if the selected option is "no frame"
                            // Assuming val.value or another property identifies the no-frame option (adjust if your data differs)
                            if (val.value.toLowerCase() === 'no frame' || val.value.toLowerCase() === 'none') {
                                localStorage.removeItem(`selectedFramePortrait_${currentCategoryId}`);
                                localStorage.removeItem(`selectedFrameLandscape_${currentCategoryId}`);

                                // Remove frame overlay immediately
                                const previewContainer = document.querySelector('.preview');
                                const existingFrame = previewContainer.querySelector('.frame-overlay');
                                if (existingFrame) existingFrame.remove();
                            } else {
                                if (val.image_portrait_path) {
                                    localStorage.setItem(`selectedFramePortrait_${currentCategoryId}`, `/storage/${val.image_portrait_path}`);
                                } else {
                                    localStorage.removeItem(`selectedFramePortrait_${currentCategoryId}`);

                                }
                                if (val.image_landscape_path) {
                                    localStorage.setItem(`selectedFrameLandscape_${currentCategoryId}`, `/storage/${val.image_landscape_path}`);
                                } else {
                                    localStorage.removeItem(`selectedFrameLandscape_${currentCategoryId}`);
                                }
                            }
                        }


                        applyPriceAndAttributes();
                        updateMainImage();
                    };



                    optionsDiv.appendChild(optionCard);
                });

                attrWrapper.appendChild(optionsDiv);

            } else if (attr.input_type === "select_area") {
                const rowDiv = document.createElement('div');
                rowDiv.className = 'row select-area-inputs mb-3';

                const colHeight = document.createElement('div');
                colHeight.className = 'col-4';
                const heightLabel = document.createElement('label');
                heightLabel.textContent = `Height (${attr.area_unit}): `;
                const heightInput = document.createElement('input');
                heightInput.type = 'number';
                heightInput.step = '2';
                heightInput.min = 0;
                heightInput.placeholder = 'Enter height';
                heightLabel.appendChild(heightInput);
                colHeight.appendChild(heightLabel);

                const colWidth = document.createElement('div');
                colWidth.className = 'col-4';
                const widthLabel = document.createElement('label');
                widthLabel.textContent = `Width (${attr.area_unit}): `;
                const widthInput = document.createElement('input');
                widthInput.type = 'number';
                widthInput.step = '2';
                widthInput.min = 0;
                widthInput.placeholder = 'Enter width';
                widthLabel.appendChild(widthInput);
                colWidth.appendChild(widthLabel);



                rowDiv.appendChild(colHeight);
                rowDiv.appendChild(colWidth);

                const colArea = document.createElement('div');
                colArea.className = 'col-4 col-area';
                const areaLabel = document.createElement('label');
                areaLabel.textContent = 'Area: ';
                const areaInput = document.createElement('input');
                areaInput.type = 'text';
                areaInput.readOnly = true;
                areaInput.tabIndex = -1;
                areaInput.className = 'font-weight-bold';
                areaInput.value = '0 ' + attr.area_unit;
                areaLabel.appendChild(areaInput);
                colArea.appendChild(areaLabel);
                rowDiv.appendChild(colArea);

                attrWrapper.appendChild(rowDiv);

                const heightErrorDiv = document.createElement('div');
                heightErrorDiv.className = 'validation-error text-danger';
                heightErrorDiv.dataset.attributeId = attr.id;
                heightErrorDiv.dataset.field = 'height';
                heightErrorDiv.style.display = 'none';
                colHeight.appendChild(heightErrorDiv);

                const widthErrorDiv = document.createElement('div');
                widthErrorDiv.className = 'validation-error text-danger';
                widthErrorDiv.dataset.attributeId = attr.id;
                widthErrorDiv.dataset.field = 'width';
                widthErrorDiv.style.display = 'none';
                colWidth.appendChild(widthErrorDiv);

                if (!(attr.id in currentSelections)) {
                    currentSelections[attr.id] = { height: null, width: null };
                }

                function updateAreaDisplay() {
                    const heightVal = parseFloat(heightInput.value) || 0;
                    const widthVal = parseFloat(widthInput.value) || 0;
                    const area = heightVal * widthVal;
                    areaInput.value = `${area.toFixed(2)} ${attr.area_unit}`;
                }

                updateAreaDisplay();

                heightInput.addEventListener('input', () => {
                    const value = parseFloat(heightInput.value);
                    if (!isValidEvenNumber(value)) {
                        showFieldValidationError(attr.id, 'height', 'Height must be an even number.');
                    } else {
                        hideFieldValidationError(attr.id, 'height');
                        applyPriceAndAttributes();
                        updateAreaDisplay();
                    }
                    currentSelections[attr.id].height = value;
                });

                widthInput.addEventListener('input', () => {
                    const value = parseFloat(widthInput.value);
                    if (!isValidEvenNumber(value)) {
                        showFieldValidationError(attr.id, 'width', 'Width must be an even number.');
                    } else {
                        hideFieldValidationError(attr.id, 'width');
                        updateAreaDisplay();
                        applyPriceAndAttributes();
                    }
                    currentSelections[attr.id].width = value;
                });

            } else if (attr.input_type === "select_colour") {
                const optionsDiv = document.createElement("div");
                optionsDiv.className = "options cards";
                attr.values.forEach((val, idx) => {
                    const optionCard = document.createElement("div");
                    optionCard.className = "option-card";
                    optionCard.dataset.valueId = val.id;

                    if (currentSelections[attr.id] === val.id) {
                        optionCard.classList.add("active");
                    } else if (currentSelections[attr.id] === undefined && idx === 0) {
                        optionCard.classList.add("active");
                        currentSelections[attr.id] = val.id;
                        parentSelectionsToProcess.push({ attrId: attr.id, valId: val.id });

                        currentSelections[`${attr.id}_colour_code`] = val.colour_code;
                        if (attr.required_file_uploads && val.required_file_uploads && val.required_file_uploads > 0) {
                            updateUploadInputs(val.required_file_uploads);
                        }
                    }

                    optionCard.innerHTML = `
                    <div class="colour-swatch" style="width:130px; height:130px; border-radius:7px; background:${val.colour_code || '#eee'}; border:10px solid #ddd; margin-bottom:8px;"></div>
                    <p>${val.value}</p>
                `;

                    optionCard.onclick = () => {

                        optionsDiv.querySelectorAll(".option-card").forEach(card => card.classList.remove("active"));
                        optionCard.classList.add("active");
                        currentSelections[attr.id] = val.id;
                        updateDependentAttributeImages(attr.id, val.id);
                        currentSelections[`${attr.id}_colour_code`] = val.colour_code;

                        if (attr.required_file_uploads && val.required_file_uploads && val.required_file_uploads > 0) {
                            updateUploadInputs(val.required_file_uploads);
                        }

                        applyPriceAndAttributes();
                        updateMainImage();
                    };

                    optionsDiv.appendChild(optionCard);
                });

                attrWrapper.appendChild(optionsDiv);


                if (currentSelections[attr.id] === undefined && attr.values.length > 0) {
                    currentSelections[attr.id] = attr.values[0].id;
                    currentSelections[`${attr.id}_colour_code`] = attr.values[0].colour_code;
                }
            } else if (attr.input_type === "radio") {
                const optionsDiv = document.createElement("div");
                optionsDiv.className = "radio-options";

                attr.values.forEach((val, idx) => {
                    const radioWrapper = document.createElement("label");
                    radioWrapper.style.width = "140px";
                    radioWrapper.style.background = "#f4f4f4";
                    radioWrapper.style.display = "flex";             // use flex layout for better alignment
                    radioWrapper.style.alignItems = "center";
                    radioWrapper.style.cursor = "pointer";           // pointer on hover
                    radioWrapper.style.marginBottom = "10px";        // spacing between radios
                    radioWrapper.style.padding = "8px 12px";          // add some padding
                    radioWrapper.style.border = "1px solid #ccc";     // border for visibility
                    radioWrapper.style.borderRadius = "5px";         // rounded corners
                    radioWrapper.style.userSelect = "none";           // prevent accidental text select

                    const radioInput = document.createElement("input");
                    radioInput.type = "radio";
                    radioInput.name = `attribute_${attr.id}`;
                    radioInput.value = val.id;
                    radioInput.checked = (currentSelections[attr.id] === val.id) || (currentSelections[attr.id] === undefined && idx === 0);
                    if (idx === 0 && attr.required_file_uploads && val.required_file_uploads && val.required_file_uploads > 0) {
                        updateUploadInputs(val.required_file_uploads);
                        parentSelectionsToProcess.push({ attrId: attr.id, valId: val.id });

                    }
                    radioInput.style.marginRight = "12px";            // space between radio and label text
                    radioInput.style.width = "18px";                   // larger size
                    radioInput.style.height = "18px";

                    const labelText = document.createTextNode(val.value);

                    radioInput.addEventListener("change", () => {
                        currentSelections[attr.id] = val.id;
                        updateDependentAttributeImages(attr.id, val.id);
                        applyPriceAndAttributes();
                        if (attr.required_file_uploads && val.required_file_uploads && val.required_file_uploads > 0) {

                            updateUploadInputs(val.required_file_uploads);
                        }
                    });

                    radioWrapper.appendChild(radioInput);
                    radioWrapper.appendChild(labelText);
                    optionsDiv.appendChild(radioWrapper);
                });

                attrWrapper.appendChild(optionsDiv);

                if (currentSelections[attr.id] === undefined && attr.values.length > 0) {
                    currentSelections[attr.id] = attr.values[0].id;
                }
            }


            else {
                const unsupported = document.createElement("p");
                unsupported.textContent = "Unsupported input type.";
                attrWrapper.appendChild(unsupported);
            }

            container.appendChild(attrWrapper);
        });

        // After rendering *all* these options for this step:
        parentSelectionsToProcess.forEach(sel => {
            updateDependentAttributeImages(sel.attrId, sel.valId);
        });

        const navDiv = document.createElement("div");
        navDiv.className = "step-nav";

        if (stepNumber > 1) {
            const prevBtn = document.createElement("button");
            prevBtn.className = "prev-btn";
            prevBtn.textContent = "← Previous step";
            prevBtn.onclick = () => goToStep(stepNumber - 1);
            navDiv.appendChild(prevBtn);
        }
        if (stepNumber < totalSteps) {
            const nextBtn = document.createElement("button");
            nextBtn.className = "next-btn";
            nextBtn.textContent = "Next step →";
            nextBtn.onclick = () => nextStep();
            navDiv.appendChild(nextBtn);
        } else {
            const finishBtn = document.createElement("button");
            finishBtn.className = "next-btn";
            finishBtn.textContent = "Finish";
            finishBtn.onclick = () => alert("All steps completed!");
            navDiv.appendChild(finishBtn);
        }

        container.appendChild(navDiv);

        applyPriceAndAttributes();
    }

    // Apply attribute conditions
    function applyAttributeConditions(currentSelections) {
        const attributeVisibility = {};

        document.querySelectorAll('[data-attribute-id]').forEach(attrEl => {
            const attrId = parseInt(attrEl.dataset.attributeId, 10);
            attributeVisibility[attrId] = {
                visible: true,
                allowedValues: null
            };
        });

        attributeVisibilityLoop:
        for (const cond of attributeConditions) {
            const parentSelectedValue = currentSelections[cond.parent_attribute_id];
            if (parentSelectedValue === cond.parent_value_id) {
                const attrVis = attributeVisibility[cond.affected_attribute_id];
                if (!attrVis) continue;

                switch (cond.action) {
                    case "hide_attribute":
                        attrVis.visible = false;
                        attrVis.allowedValues = null;
                        continue attributeVisibilityLoop;
                    case "show_attribute":
                        attrVis.visible = true;
                        attrVis.allowedValues = null;
                        break;
                    case "show_values":
                        attrVis.visible = true;
                        if (attrVis.allowedValues === null) {
                            attrVis.allowedValues = new Set(cond.affected_value_ids);
                        } else {
                            attrVis.allowedValues = new Set(cond.affected_value_ids.filter(id => attrVis.allowedValues.has(id)));
                        }
                        break;
                }
            } else {
                if (cond.action === "show_attribute" || cond.action === "show_values") {
                    const attrVis = attributeVisibility[cond.affected_attribute_id];
                    if (!attrVis) continue;
                    if (attrVis.allowedValues === null) {
                        attrVis.visible = false;
                        attrVis.allowedValues = null;
                    }
                }
            }
        }

        for (const [attrId, visInfo] of Object.entries(attributeVisibility)) {
            const attrEl = document.querySelector(`[data-attribute-id='${attrId}']`);
            if (!attrEl) continue;

            attrEl.style.display = visInfo.visible ? "block" : "none";

            if (visInfo.visible && visInfo.allowedValues !== null) {
                attrEl.querySelectorAll(".option-card").forEach(opt => {
                    const valId = parseInt(opt.dataset.valueId, 10);
                    if (visInfo.allowedValues.has(valId)) {
                        opt.style.display = "block";
                    } else {
                        opt.style.display = "none";
                        if (currentSelections[attrId] === valId) {
                            currentSelections[attrId] = null;
                            delete currentSelections[`${attrId}_frame_image`];
                        }
                    }
                });

                if (!currentSelections[attrId] || !visInfo.allowedValues.has(currentSelections[attrId])) {
                    const firstVisible = attrEl.querySelector(".option-card:not([style*='display: none'])");
                    if (firstVisible && currentStep !== 3) {
                        const newValId = parseInt(firstVisible.dataset.valueId, 10);
                        currentSelections[attrId] = newValId;
                        attrEl.querySelectorAll(".option-card").forEach(opt => {
                            opt.classList.toggle("active", parseInt(opt.dataset.valueId, 10) === newValId);
                        });
                    }
                }
            } else if (visInfo.visible) {
                attrEl.querySelectorAll(".option-card").forEach(opt => opt.style.display = "block");
            }
        }

        // Clear frame image if Step 3 is not active or no frame is selected
        if (currentStep !== 3) {
            for (const key of Object.keys(currentSelections)) {
                if (key.includes('_frame_image')) {
                    delete currentSelections[key];
                }
            }
        }
    }

    // Validation functions
    function isValidEvenNumber(value) {
        return Number.isInteger(value) && value % 2 === 0;
    }

    function showFieldValidationError(attrId, field, message) {
        const errorDiv = document.querySelector(`.validation-error[data-attribute-id='${attrId}'][data-field='${field}']`);
        if (errorDiv) {
            errorDiv.innerText = message;
            errorDiv.style.display = 'block';
        }
    }

    function hideFieldValidationError(attrId, field) {
        const errorDiv = document.querySelector(`.validation-error[data-attribute-id='${attrId}'][data-field='${field}']`);
        if (errorDiv) {
            errorDiv.innerText = '';
            errorDiv.style.display = 'none';
        }
    }

    // Fetch price
    function fetchPrice() {
        if (!currentCategoryId) return;

        // Sync height and width inputs from DOM to currentSelections
        document.querySelectorAll('[data-attribute-id]').forEach(attrEl => {
            const attrId = attrEl.dataset.attributeId;
            const heightInput = attrEl.querySelector('input[type=number][placeholder*=height]');
            const widthInput = attrEl.querySelector('input[type=number][placeholder*=width]');
            if (heightInput && widthInput) {
                if (!currentSelections[attrId] || typeof currentSelections[attrId] !== 'object') {
                    currentSelections[attrId] = {};
                }
                currentSelections[attrId].height = heightInput.value;
                currentSelections[attrId].width = widthInput.value;
            }
        });

        const filteredSelections = {};
        for (const [attrId, val] of Object.entries(currentSelections)) {
            if (attrId.includes('_colour_code') || attrId.includes('_frame_image')) continue;
            const attrEl = document.querySelector(`[data-attribute-id='${attrId}']`);
            if (!attrEl || attrEl.style.display === "none") continue;

            if (val !== null) {
                filteredSelections[attrId] = val;
            }
        }

        $.ajax({
            url: '/get-price',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                selections: JSON.stringify(filteredSelections),
                category_id: currentCategoryId
            },
            success: function (response) {
                if (response.success) {
                    if (response.price) {
                        updateSubtotal(parseFloat(response.price));
                        updatePriceUI(response.price);
                    }
                    showValidationErrors(null);
                } else {
                    if (response.errors) {
                        showValidationErrors(response.errors);
                    }
                    updateSubtotal(0);
                    updatePriceUI("N/A");
                }
            },
            error: function () {
                updateSubtotal(0);
                updatePriceUI("N/A");
            }
        });
    }

    function showValidationErrors(errors) {
        document.querySelectorAll('.validation-error').forEach(el => {
            el.innerText = '';
            el.style.display = 'none';
        });

        if (!errors) return;

        for (const attrId in errors) {
            const err = errors[attrId];
            if (typeof err === 'object' && err !== null) {
                if (err.height) {
                    showFieldValidationError(attrId, 'height', err.height);
                }
                if (err.width) {
                    showFieldValidationError(attrId, 'width', err.width);
                }
            } else if (typeof err === 'string') {
                showFieldValidationError(attrId, 'height', err);
            }
        }
    }


    // Update price UI
    function updatePriceUI(price) {
        const newPriceElem = document.querySelector('.offer .new-price');
        if (newPriceElem) newPriceElem.textContent = `£${price}`;
    }

    // Update subtotal
    let attributeBasePrice = 0; // Store the latest attribute price from backend

    // Update the subtotal showing attribute price plus selected extra options
    function updateSubtotal(basePrice) {
        attributeBasePrice = basePrice;

        // Sum of prices of all checked extra options
        const selectedOptions = document.querySelectorAll('input[name="extra_options[]"]:checked');
        let extrasTotal = 0;
        selectedOptions.forEach(cb => {
            extrasTotal += parseFloat(cb.dataset.price) || 0;
        });

        // Total price is attribute price plus extras total
        const totalPrice = attributeBasePrice + extrasTotal;

        // Display updated price with 2 decimals and £ symbol
        const subtotalElem = document.getElementById('subtotal-amount');
        if (subtotalElem) {
            subtotalElem.textContent = `£${totalPrice.toFixed(2)}`;
        }
    }

    // Combined function to apply attribute conditions and fetch price
    function applyPriceAndAttributes() {
        applyAttributeConditions(currentSelections);
        fetchPrice();
    }

    function updateMainImage() {
        const portraitPreview = document.getElementById("portraitPreview");
        const landscapePreview = document.getElementById("landscapePreview");
        const mainImgPortrait = document.getElementById("mainImagePortrait");
        const frameOverlayPortrait = document.getElementById("frameOverlayPortrait");
        const mainImgLandscape = document.getElementById("mainImageLandscape");
        const frameOverlayLandscape = document.getElementById("frameOverlayLandscape");

        if (!mainImgPortrait || !mainImgLandscape || !portraitPreview || !landscapePreview) return;

        // Find the attribute that controls the main frame change
        let mainFrameAttr = null;
        for (let attrId in loadedAttributes) {
            if (loadedAttributes[attrId].main_frame_changes) {
                mainFrameAttr = loadedAttributes[attrId];
                break;
            }
        }

        if (mainFrameAttr) {
            const selectedValId = currentSelections[mainFrameAttr.id];
            // Find the option element in the DOM for the selected value
            const optionEl = document.querySelector(`[data-attribute-id='${mainFrameAttr.id}'] .option-card[data-value-id='${selectedValId}']`);

            if (!optionEl) return;

            // Get the image inside this option card
            const imgEl = optionEl.querySelector('img');
            if (!imgEl) return;

            // Get image src from img element
            let mainImageSrc = imgEl.src || "";
            if (mainImageSrc && !mainImageSrc.startsWith('http')) {
                // If relative path, prepend domain or base path as needed
                mainImageSrc = window.location.origin + mainImageSrc;
            }


            // Get orientation from stored mapping or default to portrait
            const orientation = imgEl.getAttribute('data-orientation') || 'portrait';

            if (orientation === 'portrait') {
                portraitPreview.style.display = "block";
                landscapePreview.style.display = "none";
                mainImgPortrait.src = mainImageSrc;

                const selectedColour = Object.values(currentSelections).find(val => typeof val === "string" && val.startsWith("#"));
                portraitPreview.style.backgroundColor = selectedColour || "";
                mainImgPortrait.style.border = selectedColour ? `0px solid ${selectedColour}` : "";

                const frameImg = localStorage.getItem(`selectedFramePortrait_${currentCategoryId}`);
                if (frameImg) {
                    frameOverlayPortrait.src = frameImg;
                    frameOverlayPortrait.style.display = "block";
                } else {
                    frameOverlayPortrait.style.display = "none";
                }
                frameOverlayLandscape.style.display = "none";


            } else if (orientation === 'landscape') {
                // Show landscape version
                landscapePreview.style.display = "block";
                portraitPreview.style.display = "none";
                mainImgLandscape.src = mainImageSrc;

                const selectedColour = Object.values(currentSelections).find(val => typeof val === "string" && val.startsWith("#"));
                landscapePreview.style.backgroundColor = selectedColour || "";

                mainImgLandscape.style.border = selectedColour ? `0px solid ${selectedColour}` : "";

                const frameImg = localStorage.getItem(`selectedFrameLandscape_${mainFrameAttr.id}`) || localStorage.getItem(`selectedFrameLandscape_${currentCategoryId}`);
                if (frameImg) {
                    frameOverlayLandscape.src = frameImg;
                    frameOverlayLandscape.style.display = "block";
                } else {
                    frameOverlayLandscape.style.display = "none";
                }

                // Hide portrait overlays
                frameOverlayPortrait.style.display = "none";
            }

        } else {
            // Fall back to original behavior default image

            // Default fallback image when no matched condition
            portraitPreview.style.display = "block";
            landscapePreview.style.display = "none";

            if (currentCategoryId && subcategoryThumbnails[currentCategoryId]) {
                mainImgPortrait.src = "/storage/" + subcategoryThumbnails[currentCategoryId];
            } else {
                mainImgPortrait.src = "https://mypetframe.co.uk/img/default-fallback.jpg";
            }

            const selectedColour = Object.values(currentSelections).find(val => typeof val === "string" && val.startsWith("#"));
            portraitPreview.style.backgroundColor = selectedColour || "";
            mainImgPortrait.style.border = selectedColour ? `0px solid ${selectedColour}` : "";

            frameOverlayPortrait.style.display = "none";
            frameOverlayLandscape.style.display = "none";
        }

    }



    let loadedAttributes = {}; // Global object to store attributes by id

    function loadAttributes(categoryId) {
        currentCategoryId = categoryId;
        $.ajax({
            url: "/attributes",
            method: "GET",
            data: { subcategory_id: categoryId },
            success: function (response) {
                if (response.success && response.steps) {
                    attributeConditions = response.attribute_conditions || {};
                    currentSelections = {};
                    loadedAttributes = {}; // reset on new load

                    for (let stepNum in response.steps) {
                        const attrs = response.steps[stepNum];
                        attrs.forEach(attr => {
                            loadedAttributes[attr.id] = attr; // store by attribute id
                            if (attr.values && attr.values.length > 0 && stepNum != 3) {
                                currentSelections[attr.id] = attr.values[0].id;
                                if (attr.input_type === "select_colour") {
                                    currentSelections[`${attr.id}_colour_code`] = attr.values[0].colour_code;
                                }
                            }
                        });
                    }

                    for (let step = 1; step <= 3; step++) {
                        if (response.steps[step]) {
                            renderStep(step, response.steps[step]);
                        } else {
                            const container = document.getElementById(`step-${step}`);
                            if (container) container.innerHTML = "<p>No attributes found.</p>";
                        }
                    }

                    setTimeout(() => {
                        let initialStep = 1;
                        const match = window.location.hash.match(/step=(\d+)/);
                        if (match) {
                            const stepN = parseInt(match[1], 10);
                            if (stepN >= 1 && stepN <= totalSteps) initialStep = stepN;
                        }
                        showStep(initialStep);
                    }, 50);
                }
            }
        });
    }

    let attributeValueOrientations = {};  // key: attributeValueId, value: orientation string ('portrait' | 'landscape' | etc)

    function updateDependentAttributeImages(parentAttrId, parentSelectedValueId) {
        Object.values(loadedAttributes).forEach(attr => {
            if (attr.has_image_dependency) {
                const container = document.querySelector(`[data-attribute-id='${attr.id}']`);
                if (!container) return;

                attr.values.forEach(val => {
                    const parentImg = (val.parent_images || []).find(pi => pi.parent_attribute_value_id === parentSelectedValueId);
                    if (parentImg) {
                        const optionCard = container.querySelector(`.option-card[data-value-id='${val.id}']`);
                        if (optionCard) {
                            const img = optionCard.querySelector('img');
                            if (img) {
                                img.src = `/storage/${parentImg.image_path}`;

                                // Set data-orientation attribute on image element
                                img.setAttribute('data-orientation', parentImg.orientation || '');

                                // Store orientation in global mapping
                                attributeValueOrientations[val.id] = parentImg.orientation || '';
                            }
                        }
                    }
                });
            }
        });
    }

    function loadCategoryData(categoryId) {
        currentCategoryId = categoryId;


        // Load flattened combinations for main image
        $.ajax({
            url: '/get-attribute-images',
            method: 'GET',
            data: { category_id: currentCategoryId },
            success: function (response) {
                if (response.success) {
                    imageConditions = response.conditions;
                    updateMainImage();
                }
            }
        });

        // Load grouped image conditions for option images
        $.ajax({
            url: '/get-all-image-conditions',  // Your getAllImageConditions API
            method: 'GET',
            data: { category_id: currentCategoryId },
            success: function (response) {
                if (response.success) {
                    groupedImageConditions = response.conditions || [];
                }
            }
        });
    }


    function selectSubcategory(el) {
        document.querySelectorAll(".option-card1").forEach(card => card.classList.remove("active"));
        el.classList.add("active");

        const subcategoryId = el.dataset.id;
        goToStep(1);
        loadAttributes(subcategoryId);
        loadCategoryData(subcategoryId);
        // Update thumbnails dynamically
        const container = document.getElementById('thumbnails-container');
        container.innerHTML = ''; // Clear old thumbnails

        const selectedName = el.getAttribute('data-name') || '';

        // Update the title element
        const titleEl = document.getElementById('selected-subcategory-name');
        if (titleEl) {
            titleEl.textContent = selectedName + ' Portrait';
        }


        const gallery = subcategoryGalleries[subcategoryId] || [];
        gallery.forEach(image => {
            const img = document.createElement('img');
            img.src = `/storage/${image}`; // Adjust path if needed
            img.alt = 'Thumbnail';
            img.onclick = () => changeImage(img);
            container.appendChild(img);
        });

    }



    // Collect form data
    function collectFormData() {
        const formData = new FormData();

        const photoInputs = document.querySelectorAll('input[type=file][name="photos[]"]');
        photoInputs.forEach((input, index) => {
            if (input.files.length > 0) {
                formData.append(`photos[${index}]`, input.files[0]);
            }
        });

        if (currentCategoryId) {
            formData.append('subcategory_id', currentCategoryId);
        }

        // Collect extra option
        const selectedOptions = document.querySelectorAll('input[name="extra_options[]"]:checked');
        selectedOptions.forEach((checkbox, index) => {
            formData.append(`extra_options[${index}]`, checkbox.value);
        });

        const petName = document.getElementById('petNameInput');
        if (petName) formData.append('pet_name', petName.value);

        // const petBirthdate = document.getElementById('petBirthdateInput');
        // if (petBirthdate) formData.append('pet_birthdate', petBirthdate.value);

        const petText = document.getElementById('petTextInput');
        if (petText) formData.append('pet_text', petText.value);

        const note = document.getElementById('noteInput');
        if (note) formData.append('note', note.value);

        function isElementVisible(el) {
            return el && window.getComputedStyle(el).display !== "none";
        }

        document.querySelectorAll('[data-attribute-id]').forEach(attrEl => {
            if (!isElementVisible(attrEl)) return;

            const attrId = attrEl.dataset.attributeId;

            const selectedOption = attrEl.querySelector('.option-card.active');
            if (selectedOption) {
                formData.append(`attributes[${attrId}]`, selectedOption.dataset.valueId);
            } else {
                const heightInput = attrEl.querySelector('input[type=number][placeholder*=height]');
                const widthInput = attrEl.querySelector('input[type=number][placeholder*=width]');
                if (heightInput && widthInput) {
                    formData.append(`attributes[${attrId}][height]`, heightInput.value);
                    formData.append(`attributes[${attrId}][width]`, widthInput.value);
                }
            }
        });
        // *** Add total price here to formData ***
        const totalExtrasPrice = Array.from(selectedOptions).reduce((sum, cb) => sum + (parseFloat(cb.dataset.price) || 0), 0);
        const totalPrice = (attributeBasePrice || 0) + totalExtrasPrice;
        formData.append('total_price', totalPrice.toFixed(2));
        return formData;
    }

    // Add to cart
    function addToCart() {
        const formData = collectFormData();

        const token = document.querySelector('meta[name="csrf-token"]').content;

        fetch('/cart/add', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': token },
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/cart';
                } else {
                    alert('Failed to add to cart. Please try again.');
                }
            })
            .catch(() => {
                alert('Failed to add to cart. Please try again.');
            });
    }

    // Design second portrait
    document.getElementById('designSecondPortrait').addEventListener('click', function (e) {
        e.preventDefault();

        const formData = collectFormData();

        const token = document.querySelector('meta[name="csrf-token"]').content;

        fetch('/cart/add', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': token },
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/';
                } else {
                    alert('Failed to add item. Please try again.');
                }
            })
            .catch(() => {
                alert('Failed to add item. Please try again.');
            });
    });

    // Initialization
    document.addEventListener("DOMContentLoaded", () => {
        let initialStep = 1;
        const match = window.location.hash.match(/step=(\d+)/);
        if (match) {
            const stepN = parseInt(match[1], 10);
            if (stepN >= 1 && stepN <= totalSteps) initialStep = stepN;
        }
        showStep(initialStep);
        const defaultCategory = document.querySelector(".option-card1.active, .option-card1:first-child");
        if (defaultCategory) {
            loadAttributes(defaultCategory.dataset.id);
            loadCategoryData(defaultCategory.dataset.id);
        }

        // Photo upload initialization
        const uploadBlock = document.getElementById('upload-block');
        const addPhotoBtn = document.getElementById('add-photo-btn');
        const previewContainer = document.getElementById('preview-container');

        let inputCount = 0;

        function createUploadInput() {
            const uploadDiv = document.createElement('div');
            uploadDiv.classList.add('upload-box');
            uploadDiv.style.marginTop = '10px';

            const label = document.createElement('label');
            label.className = 'upload-btn';
            label.innerHTML = '<b>Choose a photo</b>';
            label.style.cursor = 'pointer';

            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'photos[]';
            input.accept = 'image/*';
            input.hidden = true;

            const fileId = 'file-input-' + inputCount++;
            input.dataset.fileId = fileId;

            const fileNameSpan = document.createElement('span');
            fileNameSpan.className = 'file-name';
            fileNameSpan.style.marginLeft = '10px';
            fileNameSpan.style.fontSize = '0.9em';

            label.appendChild(input);
            uploadDiv.appendChild(label);
            uploadDiv.appendChild(fileNameSpan);

            input.addEventListener('change', () => {
                if (input.files && input.files[0]) {
                    fileNameSpan.textContent = input.files[0].name;

                    const existingPreview = previewContainer.querySelector(`img[data-file-id="${fileId}"]`);
                    if (existingPreview) {
                        previewContainer.removeChild(existingPreview);
                    }

                    showPreview(input.files[0], fileId);
                } else {
                    fileNameSpan.textContent = '';
                    const existingPreview = previewContainer.querySelector(`img[data-file-id="${fileId}"]`);
                    if (existingPreview) {
                        previewContainer.removeChild(existingPreview);
                    }
                }
            });

            label.addEventListener('click', () => input.click());

            return uploadDiv;
        }

        function showPreview(file, fileId) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.dataset.fileId = fileId;
                img.style.height = '80px';
                img.style.border = '1px solid #ccc';
                img.style.borderRadius = '4px';
                img.style.objectFit = 'cover';
                img.style.marginRight = '8px';
                img.style.marginTop = '8px';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }

        addPhotoBtn.addEventListener('click', () => {
            const newUpload = createUploadInput();
            uploadBlock.parentNode.insertBefore(newUpload, addPhotoBtn);
        });

        const firstInput = uploadBlock.querySelector('input[type=file]');
        const firstFileNameSpan = uploadBlock.querySelector('.file-name');
        firstInput.dataset.fileId = 'file-input-0';
        inputCount = 1;

        firstInput.addEventListener('change', () => {
            if (firstInput.files && firstInput.files[0]) {
                firstFileNameSpan.textContent = firstInput.files[0].name;

                const existingPreview = previewContainer.querySelector(`img[data-file-id="${firstInput.dataset.fileId}"]`);
                if (existingPreview) {
                    previewContainer.removeChild(existingPreview);
                }
                showPreview(firstInput.files[0], firstInput.dataset.fileId);
            } else {
                firstFileNameSpan.textContent = '';
                const existingPreview = previewContainer.querySelector(`img[data-file-id="${firstInput.dataset.fileId}"]`);
                if (existingPreview) {
                    previewContainer.removeChild(existingPreview);
                }
            }
        });

        // Modal handling for info modal
        const modal = document.getElementById('infoModal');
        const closeBtn = document.getElementById('closeModalBtn');
        const moreInfoLink = document.querySelector('.upload-help a');

        moreInfoLink.addEventListener('click', (e) => {
            e.preventDefault();
            modal.style.display = 'flex';
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Modal handling for photo tips
        const tipModal = document.getElementById('tipModal');
        const tipModalClose = document.getElementById('tipModalClose');
        const tipLink = document.querySelector('.maintop-banner a');

        tipLink.addEventListener('click', (e) => {
            e.preventDefault();
            tipModal.style.display = 'flex';
        });

        tipModalClose.addEventListener('click', () => {
            tipModal.style.display = 'none';
        });

        tipModal.addEventListener('click', (e) => {
            if (e.target === tipModal) {
                tipModal.style.display = 'none';
            }
        });
    });


    // Attach event listeners to extra options checkboxes
    document.addEventListener("DOMContentLoaded", () => {
        // Initial fetch of attribute price
        fetchPrice();

        // Attach listener for extra option changes to recalc subtotal dynamically
        document.querySelectorAll('input[name="extra_options[]"]').forEach(cb => {
            cb.addEventListener('change', () => {
                // On extras selected/unselected, recalc subtotal (attribute price + extras)
                updateSubtotal(attributeBasePrice);
            });
        });
    });

</script>