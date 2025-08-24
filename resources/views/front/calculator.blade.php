<!-- Start Main Slider -->
<section class="maintop-banner style1">
    <div class="container">
        <h2>Select Category</h2>
        <div class="options cards mb-5">
            @foreach($subcategories as $subcategory)
                <div class="option-card1 {{ $loop->first ? 'active' : '' }}" data-id="{{ $subcategory->id }}"
                    onclick="selectSubcategory(this)">
                    <img src="{{ asset('storage/' . ($subcategory->thumbnail ?? '')) }}"
                        alt="{{ $subcategory->name ?? ''}}">
                    <p>{{ $subcategory->name ?? ''}}</p>
                </div>
            @endforeach
        </div>

        <div class="row align-items-start">
            <!-- Left Part -->
            <div class="col-lg-6 left-part">
                <h2>Cartoon Portrait</h2>
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
                        <h4 class="mb-2">Upload a picture of your pet</h4>
                        <a href="#" class="tips-link">📷 Click here for photo tips</a>

                        <div class="upload-box" id="upload-block">
                            <label class="upload-btn">
                                <b>Choose a photo</b>
                                <input type="file" name="photos[]" accept="image/*" hidden>
                            </label>
                            <span class="file-name"></span>
                        </div>
                        <button type="button" id="add-photo-btn">+ Add photo</button>

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
                            <input id="petNameInput" type="text" placeholder="Name of pet(s) - optional">
                            <input id="petBirthdateInput" type="text" placeholder="Birthdate - optional">
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
                    <div class="step-box" id="step-5" style="display:none;">
                        <h3 class="mb-3" style="font-size:1.6rem; margin-bottom:18px; font-weight:bold;">Extra options
                        </h3>

                        <div style="margin-bottom:36px;">
                            <label style="display:flex; align-items:flex-start; cursor:pointer; margin-bottom:18px;">
                                <input type="radio" name="extra_option" value="digital" checked
                                    style="accent-color:#ff3b7c; width:20px; height:20px; margin-right:8px; margin-top:2px;">
                                <div>
                                    <span style="font-weight:bold;">Digital download + <span
                                            style="font-weight:700;">£0.00</span></span>
                                    <div style="color:#888; font-size:1rem; margin-top:3px;">
                                        You will receive a file with your artwork that you can keep as a background,
                                        profile picture or forever!
                                    </div>
                                </div>
                            </label>
                            <label style="display:flex; align-items:flex-start; cursor:pointer;">
                                <input type="radio" name="extra_option" value="skip"
                                    style="accent-color:#ff3b7c; width:20px; height:20px; margin-right:8px; margin-top:2px;">
                                <div>
                                    <span style="font-weight:bold;">Skip the line + <span
                                            style="font-weight:700;">£9.95</span></span>
                                    <div style="color:#888; font-size:1rem; margin-top:3px;">
                                        Skip the line so we can prioritize your drawing over others!
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div style="font-size:1.3rem; text-align:right; margin-bottom:36px;">
                            <b>Subtotal:</b> <span id="subtotal-amount"
                                style="font-weight:bold; font-size:1.25em;">£0.00</span>
                        </div>

                        <div style="display:flex; gap:24px;">
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
            <div class="col-lg-6 right-part text-center">
                <div class="preview">
                    <img src="https://mypetframe.co.uk/cdn/shop/products/Ice.jpg?v=1658839616" alt="Pet Portrait"
                        class="preview-img" id="main-img">
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
    // Global state
    let currentSelections = {};
    let attributeConditions = [];
    const totalSteps = 5;
    let currentCategoryId = null;
    let currentStep = 1; // To track the current step
    let imageConditions = []; // [{ combination: {attrId1: valueId1, attrId2: valueId2}, image: 'path.jpg' }, ...]

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

    // Check if step is empty (no visible attribute-block)
    function isStepEmpty(step) {
        if (step === 4 || step === 5) return false; // always show these steps
        const container = document.getElementById(`step-${step}`);
        if (!container) return true;
        return !Array.from(container.querySelectorAll('.attribute-block'))
            .some(el => el.style.display !== 'none');
    }

    // Go to a step, skipping empty steps forward if necessary
    function goToStep(step) {
        if (step < 1) step = 1;
        if (step > totalSteps) step = totalSteps;

        while (step <= totalSteps && isStepEmpty(step)) {
            step++;
        }

        if (step > totalSteps) {
            // fallback: stay on last step or show message
            step = totalSteps;
        }

        showStep(step);
    }

    // Advance to next step skipping empty ones
    function nextStep() {
        let next = currentStep + 1;
        while (next <= totalSteps && isStepEmpty(next)) {
            next++;
        }
        if (next > totalSteps) {
            alert('All steps completed!');
        } else {
            goToStep(next);
        }
    }

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

        attributes.forEach(attr => {
            const attrWrapper = document.createElement("div");
            attrWrapper.className = "attribute-block";
            attrWrapper.dataset.attributeId = attr.id;

            // Title
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

                    // If currentSelections for this attribute exists and matches this value, mark active
                    // Otherwise, if no selection yet, mark first option as active and set currentSelection
                    if (currentSelections[attr.id] === val.id) {
                        optionCard.classList.add("active");
                    } else if (currentSelections[attr.id] === undefined && idx === 0) {
                        optionCard.classList.add("active");
                        currentSelections[attr.id] = val.id; // Set selection here
                    }

                    optionCard.innerHTML = `
        <img src="/storage/${val.image_path}" alt="${val.value}">
        <p>${val.value}</p>
    `;

                    optionCard.onclick = () => {
                        // Remove 'active' from siblings, add to clicked
                        optionsDiv.querySelectorAll(".option-card").forEach(card => card.classList.remove("active"));
                        optionCard.classList.add("active");

                        // Update selection and UI
                        currentSelections[attr.id] = val.id;
                        applyPriceAndAttributes();
                        updateMainImage();
                    };

                    optionsDiv.appendChild(optionCard);
                });



                attrWrapper.appendChild(optionsDiv);

                if (currentSelections[attr.id] === undefined && attr.values.length > 0) {
                    currentSelections[attr.id] = attr.values[0].id;
                }
            } else if (attr.input_type === "select_area") {
                // Layout height and width side-by-side
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

                attrWrapper.appendChild(rowDiv);

                // Height input
                const heightErrorDiv = document.createElement('div');
                heightErrorDiv.className = 'validation-error text-danger';
                heightErrorDiv.dataset.attributeId = attr.id;
                heightErrorDiv.dataset.field = 'height';
                heightErrorDiv.style.display = 'none';
                colHeight.appendChild(heightErrorDiv);

                // Width input
                const widthErrorDiv = document.createElement('div');
                widthErrorDiv.className = 'validation-error text-danger';
                widthErrorDiv.dataset.attributeId = attr.id;
                widthErrorDiv.dataset.field = 'width';
                widthErrorDiv.style.display = 'none';
                colWidth.appendChild(widthErrorDiv);

                // After colHeight and colWidth

                const colArea = document.createElement('div');
                colArea.className = 'col-4 col-area'; // Use smaller width (or col-12 if stacking)
                const areaLabel = document.createElement('label');
                areaLabel.textContent = 'Area: ';

                // Create the read-only area input
                const areaInput = document.createElement('input');
                areaInput.type = 'text';
                areaInput.readOnly = true;
                areaInput.tabIndex = -1; // Skip from tab
                areaInput.className = 'font-weight-bold';  // style as needed
                areaInput.value = '0 ' + attr.area_unit;

                areaLabel.appendChild(areaInput);
                colArea.appendChild(areaLabel);

                // Append to rowDiv after height/width
                rowDiv.appendChild(colArea);


                // Initialize selection placeholders as object for area inputs
                if (!(attr.id in currentSelections)) {
                    currentSelections[attr.id] = { height: null, width: null };
                }

                function updateAreaDisplay() {
                    const heightVal = parseFloat(heightInput.value) || 0;
                    const widthVal = parseFloat(widthInput.value) || 0;
                    const area = heightVal * widthVal;
                    areaInput.value = `${area.toFixed(2)} ${attr.area_unit}`;
                }



                // Call this ONCE here to initialize the area display
                updateAreaDisplay();

                heightInput.addEventListener('input', () => {
                    const value = parseFloat(heightInput.value);
                    // no validation on odd numbers here as per your logic
                    hideFieldValidationError(attr.id, 'height');
                    currentSelections[attr.id].height = value;
                    updateAreaDisplay();
                    applyPriceAndAttributes();
                });

                widthInput.addEventListener('input', () => {
                    const value = parseFloat(widthInput.value);
                    hideFieldValidationError(attr.id, 'width');
                    currentSelections[attr.id].width = value;
                    updateAreaDisplay();
                    applyPriceAndAttributes();
                });

            }
            else {
                const unsupported = document.createElement("p");
                unsupported.textContent = "Unsupported input type.";
                attrWrapper.appendChild(unsupported);
            }

            container.appendChild(attrWrapper);
        });

        // Navigation buttons
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

        applyPriceAndAttributes();  // Apply conditions & fetch price on render
    }



    // Apply attribute conditions and update UI
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
                        }
                    }
                });

                if (!currentSelections[attrId] || !visInfo.allowedValues.has(currentSelections[attrId])) {
                    const firstVisible = attrEl.querySelector(".option-card:not([style*='display: none'])");
                    if (firstVisible) {
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
    }

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


    // Fetch price from backend using current selections
    function fetchPrice() {
        if (!currentCategoryId) return;

        const filteredSelections = {};

        for (const [attrId, val] of Object.entries(currentSelections)) {
            // Find attribute element and check visibility
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
                        updateSubtotal(response.price);
                        updatePriceUI(response.price);
                    }
                    showValidationErrors(null); // clear errors on success
                } else {
                    if (response.errors) {
                        showValidationErrors(response.errors);
                    } else if (response.message) {
                        alert(response.message); // fallback alert
                    }
                    updateSubtotal(0);
                    updatePriceUI("N/A");
                }
            },
            error: function () {
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

    // Update price display UI
    function updatePriceUI(price) {
        const newPriceElem = document.querySelector('.offer .new-price');
        if (newPriceElem) newPriceElem.textContent = `£${price}`;
        // Optionally update other price parts
    }


    function updateSubtotal(amount) {
        const subtotalElem = document.getElementById('subtotal-amount');
        if (subtotalElem) {
            // Format amount as currency string with £ sign, two decimals
            subtotalElem.textContent = `£${amount}`;
        }
    }


    // Combined function to apply attribute conditions and fetch updated price
    function applyPriceAndAttributes() {
        applyAttributeConditions(currentSelections);
        fetchPrice();
    }

    function updateMainImage() {
        let matched = null;
        console.log('updateMainImage', currentSelections, imageConditions);

        for (let cond of imageConditions) {
            let match = true;
            for (let attrId in cond.combination) {
                const attrKey = Number(attrId);
                console.log('Checking Attr:', attrKey, 'Selected:', currentSelections[attrKey], 'Expected:', cond.combination[attrKey]);
                if (
                    !(attrKey in currentSelections) ||
                    currentSelections[attrKey] === null ||
                    currentSelections[attrKey] === undefined ||
                    currentSelections[attrKey] !== cond.combination[attrKey]
                ) {
                    match = false;
                    break;
                }
            }
            if (match) {
                matched = cond;
                break;
            }
        }

        const mainImg = document.getElementById("main-img");
        if (mainImg) {
            if (matched) {
                mainImg.src = matched.image;
            } else {
                mainImg.src = 'https://mypetframe.co.uk/cdn/shop/products/Ice.jpg?v=1658839616'; // fallback image
            }
        }
    }



    // Load attributes based on selected category
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

                    for (let stepNum in response.steps) {
                        const attrs = response.steps[stepNum];
                        attrs.forEach(attr => {
                            if (attr.values && attr.values.length > 0) {
                                currentSelections[attr.id] = attr.values[0].id;
                            }
                        });
                    }

                    for (let step = 1; step <= 3; step++) { // render only dynamic steps 1-3
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

    function loadImages(categoryId) {
        currentCategoryId = categoryId;
        $.ajax({
            url: '/get-attribute-images', // create a route to return ImageCondition for category
            method: 'GET',
            data: { category_id: currentCategoryId },
            success: function (response) {
                if (response.success) {
                    imageConditions = response.conditions;
                    updateMainImage(); // initial image
                }
            }
        });

    }

    // Select category triggers attribute load
    function selectCategory(el) {
        const parent = el.parentElement;
        parent.querySelectorAll(".option-card1").forEach(card => card.classList.remove("active"));
        el.classList.add("active");
        loadAttributes(el.dataset.id);
    }

    function selectSubcategory(el) {
        selectCategory(el);
    }

    function collectFormData() {
        const formData = new FormData();

        // Collect photos
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
        const extraOption = document.querySelector('input[name="extra_option"]:checked');
        if (extraOption) {
            formData.append('extra_option', extraOption.value);
        }

        // Collect text inputs by IDs
        const petName = document.getElementById('petNameInput');
        if (petName) formData.append('pet_name', petName.value);

        const petBirthdate = document.getElementById('petBirthdateInput');
        if (petBirthdate) formData.append('pet_birthdate', petBirthdate.value);

        const petText = document.getElementById('petTextInput');
        if (petText) formData.append('pet_text', petText.value);

        const note = document.getElementById('noteInput');
        if (note) formData.append('note', note.value);

        function isElementVisible(el) {
            return el && window.getComputedStyle(el).display !== "none";
        }


        // Collect visible attributes only
        document.querySelectorAll('[data-attribute-id]').forEach(attrEl => {
            if (!isElementVisible(attrEl)) return; // skip hidden

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

        return formData;
    }

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
                    window.location.href = '/';  // Redirect to home for second portrait design
                } else {
                    alert('Failed to add item. Please try again.');
                }
            })
            .catch(() => {
                alert('Failed to add item. Please try again.');
            });
    });

    // Initialization on page ready
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
            loadImages(defaultCategory.dataset.id);
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
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

                    // Remove previous preview if exists
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

        // Initialize first input
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
    });

    document.addEventListener('DOMContentLoaded', () => {
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

        // Also allow clicking outside modal box to close modal
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    });

    // Modal handling for “Click here for photo tips”
    document.addEventListener('DOMContentLoaded', () => {
        const tipModal = document.getElementById('tipModal');
        const tipModalClose = document.getElementById('tipModalClose');
        const tipLink = document.querySelector('.maintop-banner a');  // Select the “Click here for photo tips” link

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
</script>