<!-- Start Main Slider -->
<section class="maintop-banner style1">
    <div class="container">
        <h2>Select Category</h2>
        <div class="options cards mb-5">
            <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="option-card1 <?php echo e($loop->first ? 'active' : ''); ?>" data-id="<?php echo e($subcategory->id); ?>"
                    onclick="selectSubcategory(this)">
                    <img src="<?php echo e(asset('storage/' . ($subcategory->thumbnail ?? ''))); ?>"
                        alt="<?php echo e($subcategory->name ?? ''); ?>">
                    <p><?php echo e($subcategory->name ?? ''); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <h4>Upload a picture of your pet</h4>
                        <a href="#" class="tips-link">📷 Click here for photo tips</a>

                        <div class="upload-box">
                            <label class="upload-btn">
                                Choose a photo
                                <input type="file" hidden>
                            </label>
                        </div>

                        <!-- Unable to upload -->
                        <div class="upload-help">
                            <input type="checkbox" id="no-upload">
                            <label for="no-upload">Are you unable to upload a photo? <a href="#">More info</a></label>
                        </div>

                        <!-- Form fields -->
                        <div class="form-fields">
                            <input type="text" placeholder="Name of pet(s) - optional">
                            <input type="text" placeholder="Birthdate(s) - optional">
                            <input type="text" placeholder="Personal text - optional">
                            <textarea
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
                        <h4>Step 5 Content</h4>
                        <p>This is dummy content for step 5.</p>
                        <button class="next-btn" onclick="alert('All steps completed!')">Finish</button>
                    </div>
                </div>
            </div>

            <!-- Right Part -->
            <div class="col-lg-6 right-part text-center">
                <div class="preview">
                    <img src="https://mypetframe.co.uk/cdn/shop/products/Ice.jpg?v=1658839616" alt="Pet Portrait"
                        class="preview-img" id="main-img">
                    <p class="pet-name">BOBBY</p>
                </div>

                <!-- Thumbnails -->
                <div class="thumbnails">
                    <img src="https://mypetframe.co.uk/cdn/shop/products/Ice.jpg?v=1658839616"
                        onclick="changeImage(this)">
                    <img src="https://mypetframe.co.uk/cdn/shop/products/Jules.jpg?v=1658839619"
                        onclick="changeImage(this)">
                    <img src="https://mypetframe.co.uk/cdn/shop/products/Lizzy.jpg?v=1658839621"
                        onclick="changeImage(this)">
                    <img src="https://mypetframe.co.uk/cdn/shop/products/Otje-Pluk.jpg?v=1658839624"
                        onclick="changeImage(this)">
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // Global state
    let currentSelections = {};
    let attributeConditions = [];
    const totalSteps = 5;
    let currentCategoryId = null;
    let currentStep = 1; // To track the current step

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

                    if (idx === 0) optionCard.classList.add("active");

                    optionCard.innerHTML = `
                    <img src="/storage/${val.image_path}" alt="${val.value}">
                    <p>${val.value}</p>
                `;
                    optionCard.onclick = () => {
                        optionsDiv.querySelectorAll(".option-card").forEach(card => card.classList.remove("active"));
                        optionCard.classList.add("active");

                        currentSelections[attr.id] = val.id;
                        applyPriceAndAttributes();
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
                _token: '<?php echo e(csrf_token()); ?>',
                selections: JSON.stringify(filteredSelections),
                category_id: currentCategoryId
            },
            success: function (response) {
                if (response.success) {
                    if (response.price) {
                        updatePriceUI(response.price);
                    }
                    showValidationErrors(null); // clear errors on success
                } else {
                    if (response.errors) {
                        showValidationErrors(response.errors);
                    } else if (response.message) {
                        alert(response.message); // fallback alert
                    }
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

    // Combined function to apply attribute conditions and fetch updated price
    function applyPriceAndAttributes() {
        applyAttributeConditions(currentSelections);
        fetchPrice();
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
        }
    });


</script><?php /**PATH D:\web-mingo-project\new\resources\views/front/calculator.blade.php ENDPATH**/ ?>