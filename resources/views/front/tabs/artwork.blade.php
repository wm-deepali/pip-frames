<script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js"
        id="dropboxjs" data-app-key="n5gi2gzrhj8v8b6"></script>
<div class="tabone-section">
   <div>
      <div class="custom-art-tab-section-left">
         <div class="custom-art-tab-cont">
            <h6>{{ $subcategory_name ?? ''}}</h6>
            <button class="custom-art-edit-btn">✎ Edit</button>
         </div>
         <div class="custom-art-card">
            <div class="custom-art-item-label">{{ $category_name }}</div>
            <div class="custom-art-field">
               <label>Copies</label>
               <input type="number" value="{{ $items['quantity'] ?? ''}}" class="custom-art-input-box" />
            </div>
            @php $paperSizeValue = collect($attributes_resolved)->firstWhere('attribute_name', 'Paper Size')['value_name'] ?? '';
            @endphp
            <div class="custom-art-field">
               <label>Size</label>
               <input
                  type="text"
                  value="{{ $paperSizeValue }}"
                  class="custom-art-input-box"
                  readonly
               />
            </div>
       

            @php
                // Randomly pick 3 or 4 attributes from the resolved collection
               $randomAttributes = collect($attributes_resolved)->shuffle()->take(4);
            @endphp
            <div class="custom-art-field custom-art-gsm-options">
               @foreach ($randomAttributes as $attribute)
               <span class="custom-art-subtext"> {{ $attribute['attribute_name'] }} - {{ $attribute['value_name'] }}</span>
               <br>
               @endforeach
            </div>

            <button class="custom-art-change-options">🔧 Change Options</button>
            <div class="custom-art-vat-row">
               <input type="checkbox" checked />
               <label>Add VAT (if applicable)</label>
            @php
  $country = $delivery['title'] ?? '';
  $vat = $vat_percentage ?? '';
@endphp

<button 
   type="button" 
   class="custom-art-info-btn"
   data-bs-toggle="popover" 
   data-bs-trigger="focus" 
   data-bs-html="true"
   title="VAT Payable?"
   data-bs-content="
      Country: <strong>{{ $country }}</strong><br>
      VAT Percentage: <strong>{{ $vat}}%</strong>"
>
   Info
</button>



            </div>
            <a href="#" class="custom-art-view-quote">📄 View this quote</a>
         </div>
      </div>
   </div>
   <div class="tab-section-right">
      <div class="custom-art-upload-buttons">
         <div class="d-flex justify-content-between">
            <input type="file" id="real-file-input"
               accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
            <!-- Custom button -->

            <button class="custom-art-btn btn-blue" type="button"
               onclick="document.getElementById('real-file-input').click()">
               <i class="fa-solid fa-cloud-arrow-up"></i> Upload File(s)
            </button>
            <button class="custom-art-btn btn-dropbox" type="button">
               <i class="fa-brands fa-dropbox"></i> Choose from Dropbox
            </button>
            <button class="custom-art-btn btn-link" data-bs-toggle="modal" data-bs-target="#pasteLinkModal">
               Paste Link to Print File
            </button>
         </div>
         <div id="uploaded-main-files" class="m-2" style="display: none"></div>
         <div class="custom-art-filetypes-box">
            <h6>File Types</h6>
            <div class="file-tags">
               <span class="tag recommended">Recommended .pdf</span>
               <span class="tag">Images</span>
               <span class="tag">PostScript</span>
               <span class="tag">MS Office</span>
               <span class="tag">OpenOffice</span>
            </div>
         </div>
         <div class="custom-art-instructions mb-3">
            <p>
               If you need to upload several files, please include a number in
               your file name. <br />
               For example: <strong>file1.pdf, file2.pdf, file3.pdf</strong> or
               <strong>page1.pdf, page2.pdf, page3.pdf</strong><br />
               Those numbers will determine the order. The words ‘front’,
               ‘back’, ‘last’, ‘inner’ are also accepted.
            </p>
         </div>
      </div>
      <textarea class="form-control text-areafield" id="orderDetailsText" rows="5"
         placeholder="Details...">{{ session('cart.details') }}</textarea>

   </div>
</div>
<div class="upload-container">
   <div class="upload-card" onclick="document.getElementById('fileInput').click();">
      <i class="fa-solid fa-arrow-up-from-bracket"></i>
      <p class="title">Drag and Drop files to upload</p>
      <p class="or">or</p>
      <button class="browse-btn">Browse</button>
      <p class="file-info">Supported files: Image, PDF</p>
   </div>
   <input type="file" id="fileInput" multiple accept="image/*,application/pdf" style="display: none"
      onchange="handleImageUpload(event)" />
   <div id="preview-container"></div>
</div>

                  <div class="text-end mt-4">
                    <button type="button" class="btn btn-primary" id="detailsTab">
                        Next <i class="fa fa-arrow-right ms-1"></i>
                    </button>
                </div>

<script>

  $(document).ready(function () {
      $('#detailsTab').on('click', function () {
         
         document.querySelectorAll('.custom-tab').forEach(tab => tab.classList.remove('active'));
         document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

         // Activate the "details" tab
         document.querySelector('.custom-tab[data-tab="details"]').classList.add('active');
         document.getElementById('details').classList.add('active');

        }
  )});

   document.addEventListener("DOMContentLoaded", function () {
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl);
    });
  });;

   document.getElementById("orderDetailsText").addEventListener("blur", function () {
      const details = this.value.trim();
      if (details !== "") {
         saveDetailsToSession(details);
      }
   });

   function saveDetailsToSession(details) {
      fetch("/cart/save-details", {
         method: "POST",
         headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Content-Type": "application/json",
         },
         body: JSON.stringify({ details }),
      })
         .then(res => res.json())
         .then(data => {
            console.log("Details saved:", data);
         })
         .catch(err => {
            console.error("Failed to save details:", err);
         });
   }


   document.addEventListener("DOMContentLoaded", async () => {
      try {
         const response = await fetch("/cart/session-files");
         const data = await response.json();

         // Handle files
         const fileArray = Object.values(data).filter(item => typeof item === 'object' && item?.type);
         fileArray.forEach((file) => {
            if (file.type === "main") {
               renderMainPreviewFromSession(file);
            } else {
               uploadedFiles.push({
                  name: file.name,
                  type: file.type,
                  path: file.path,
                  mime: file.mime,
               });
            }
         });
         renderPreviews();

         // Set textarea if 'details' exist
         if (data.details) {
            const textarea = document.getElementById("orderDetailsText");
            if (textarea) {
               textarea.value = data.details;
            }
         }

      } catch (error) {
         console.error("Failed to fetch session files:", error);
      }
   });


   async function addPastedLink() {
      const urlInput = document.getElementById("pastedLinkInput");
      const errorDiv = document.getElementById("pastedLinkError");
      let url = urlInput.value.trim();
      errorDiv.textContent = "";

      if (!url) {
         errorDiv.textContent = "Please enter a file URL.";
         return;
      }

      const isValidUrl = /^(https?:\/\/[^\s]+)$/.test(url);
      if (!isValidUrl) {
         errorDiv.textContent = "Please enter a valid URL.";
         return;
      }

      // Detect Google Docs
      const match = url.match(
         /https:\/\/docs\.google\.com\/document\/d\/([a-zA-Z0-9_-]+)/,
      );
      if (match) {
         const fileId = match[1];
         url = `https://docs.google.com/document/d/${fileId}/export?format=pdf`;
      }

      try {
         const response = await fetch(url);
         if (!response.ok) throw new Error("Unable to fetch file.");

         const blob = await response.blob();
         const fileType = blob.type || "application/pdf";
         const fileName = `pasted_file_${Date.now()}.pdf`;
         const file = new File([blob], fileName, { type: fileType });

         // 🔄 Save to backend session
         saveToSession(file, "main"); // or 'extra' if needed

         // 📄 Show preview
         const arrayBuffer = await blob.arrayBuffer();
         const loadingTask = pdfjsLib.getDocument({ data: arrayBuffer });
         const pdf = await loadingTask.promise;
         const page = await pdf.getPage(1);

         const viewport = page.getViewport({ scale: 1.0 });
         const canvas = document.createElement("canvas");
         canvas.height = viewport.height;
         canvas.width = viewport.width;
         canvas.style.width = "100%";
         canvas.style.borderRadius = "4px";

         const context = canvas.getContext("2d");
         await page.render({ canvasContext: context, viewport }).promise;

         const preview = document.createElement("div");
         preview.className = "preview-box";

         const removeBtn = document.createElement("span");
         removeBtn.className = "remove-btn";
         removeBtn.innerHTML = "&times;";

         removeBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            const removeIndex = parseInt(
               previewWrapper.getAttribute("data-index"),
            );
            const removedFile = uploadedFiles[removeIndex];

            uploadedFiles.splice(removeIndex, 1);
            renderPreviews();

            // Remove from session (extra)
            if (removedFile && removedFile.name) {
               fetch("/cart/remove-file", {
                  method: "POST",
                  headers: {
                     "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                     ).content,
                     "Content-Type": "application/json",
                  },
                  body: JSON.stringify({
                     type: "extra",
                     name: removedFile.name, // You can also store path during upload
                  }),
               });
            }
         });

         preview.appendChild(removeBtn);
         preview.appendChild(canvas);

         const container = document.getElementById("uploaded-main-files");
         container.style.display = "block";
         container.innerHTML = "";
         container.appendChild(preview);

         urlInput.value = "";
         bootstrap.Modal.getInstance(
            document.getElementById("pasteLinkModal"),
         ).hide();
      } catch (error) {
         console.error("Preview error:", error);
         errorDiv.textContent =
            "Failed to load the file. Make sure it's shared publicly.";
      }
   }

   document
      .getElementById("real-file-input")
      .addEventListener("change", function (event) {
         const file = event.target.files[0]; // Get only the first file
         renderSingleFilePreview(file);
         if (file) saveToSession(file, "main");
      });

   function renderSingleFilePreview(file) {
      const container = document.getElementById("uploaded-main-files");
      container.style.display = "block";
      container.innerHTML = ""; // Clear previous preview

      if (!file) return;

      const fileType = file.type;
      const fileName = file.name;

      const preview = document.createElement("div");
      preview.className = "preview-box";

      const removeBtn = document.createElement("span");
      removeBtn.className = "remove-btn";
      removeBtn.innerHTML = "&times;";
      removeBtn.title = "Remove File";
      removeBtn.onclick = () => {
         preview.remove();
         container.style.display = "none";
         document.getElementById("real-file-input").value = "";

         // 🧹 Remove from session (main)
         fetch("/cart/remove-file", {
            method: "POST",
            headers: {
               "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                  .content,
               "Content-Type": "application/json",
            },
            body: JSON.stringify({
               type: "main",
               path: '{{ optional(session("cart.images")) ? collect(session("cart.images"))->where("type", "main")->first()["path"] ?? "" : "" }}', // if you have the path
            }),
         });
      };

      preview.appendChild(removeBtn);

      if (fileType === "application/pdf") {
         const reader = new FileReader();
         reader.onload = function () {
            const typedarray = new Uint8Array(this.result);

            pdfjsLib
               .getDocument({ data: typedarray })
               .promise.then(function (pdf) {
                  pdf.getPage(1).then(function (page) {
                     const scale = 1.0;
                     const viewport = page.getViewport({ scale: scale });

                     const canvas = document.createElement("canvas");
                     canvas.height = viewport.height;
                     canvas.width = viewport.width;
                     canvas.style.width = "100%";
                     canvas.style.borderRadius = "4px";

                     const context = canvas.getContext("2d");
                     page
                        .render({ canvasContext: context, viewport: viewport })
                        .promise.then(() => {
                           preview.appendChild(canvas);
                        });
                  });
               })
               .catch((err) => {
                  preview.innerHTML += `<p style="color: red;">Unable to preview PDF.</p>`;
               });
         };
         reader.readAsArrayBuffer(file);
      } else if (
         fileType === "application/msword" ||
         fileType ===
         "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
      ) {
         preview.innerHTML += `
            <div style="display: flex; align-items: center;">
                <span style="font-size: 20px; margin-right: 8px;">📝</span>
                <span>${fileName}</span>
                <span style="margin-left: auto; font-size: 12px; color: #666;">(DOC/DOCX)</span>
            </div>
        `;
      } else {
         preview.innerHTML += `
            <p>${fileName} (Unsupported format)</p>
        `;
      }

      container.appendChild(preview);
   }

   function renderMainPreviewFromSession(fileInfo) {
      const container = document.getElementById("uploaded-main-files");
      container.innerHTML = "";
      container.style.display = "block";

      const preview = document.createElement("div");
      preview.className = "preview-box";

      const removeBtn = document.createElement("span");
      removeBtn.className = "remove-btn";
      removeBtn.innerHTML = "&times;";
      removeBtn.title = "Remove File";
      removeBtn.onclick = () => {
         preview.remove();
         container.style.display = "none";

         // Call remove endpoint
         fetch("/cart/remove-file", {
            method: "POST",
            headers: {
               "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                  .content,
               "Content-Type": "application/json",
            },
            body: JSON.stringify({
               type: "main",
               path: fileInfo.path,
            }),
         });
      };

      preview.appendChild(removeBtn);

      const fileUrl = `/storage/${fileInfo.path}`; // Adjust if you use a different public path
      if (fileInfo.mime === "application/pdf") {
         const loadingTask = pdfjsLib.getDocument(fileUrl);
         loadingTask.promise
            .then((pdf) => {
               pdf.getPage(1).then((page) => {
                  const scale = 1;
                  const viewport = page.getViewport({ scale });

                  const canvas = document.createElement("canvas");
                  canvas.width = viewport.width;
                  canvas.height = viewport.height;
                  canvas.style.width = "100%";
                  canvas.style.borderRadius = "4px";

                  const context = canvas.getContext("2d");
                  page.render({ canvasContext: context, viewport });
                  preview.appendChild(canvas);
               });
            })
            .catch((err) => {
               preview.innerHTML += "<p>PDF preview failed.</p>";
            });
      } else {
         const fallback = document.createElement("p");
         fallback.textContent = `${fileInfo.name}`;
         preview.appendChild(fallback);
      }

      container.appendChild(preview);
   }

   let uploadedFiles = [];

   function handleImageUpload(event) {
      const files = Array.from(event.target.files);
      files.forEach((file) => {
         uploadedFiles.push(file);
         saveToSession(file, "extra");
      });

      renderPreviews();
   }

   function renderPreviews() {
      const container = document.getElementById("preview-container");
      container.innerHTML = "";
      uploadedFiles.forEach((file, index) => {
         const preview = document.createElement("div");
         preview.className = "preview-box";

         const removeBtn = document.createElement("span");
         removeBtn.className = "remove-btn";
         removeBtn.innerHTML = "&times;";
         removeBtn.title = "Remove File";
         removeBtn.onclick = () => {
            uploadedFiles.splice(index, 1);
            renderPreviews();

            // Call remove endpoint if file has path
            if (file.path) {
               fetch("/cart/remove-file", {
                  method: "POST",
                  headers: {
                     "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                     ).content,
                     "Content-Type": "application/json",
                  },
                  body: JSON.stringify({
                     type: "extra",
                     path: file.path,
                  }),
               });
            }
         };

         preview.appendChild(removeBtn);

         const fileUrl = `/storage/${file.path}`;

         if (file.mime === "application/pdf") {
            const loadingTask = pdfjsLib.getDocument(fileUrl);
            loadingTask.promise
               .then((pdf) => {
                  pdf.getPage(1).then((page) => {
                     const scale = 1;
                     const viewport = page.getViewport({ scale });

                     const canvas = document.createElement("canvas");
                     canvas.width = viewport.width;
                     canvas.height = viewport.height;
                     canvas.style.width = "100%";

                     const context = canvas.getContext("2d");
                     page.render({ canvasContext: context, viewport });
                     preview.appendChild(canvas);
                  });
               })
               .catch(() => {
                  const fallback = document.createElement("p");
                  fallback.textContent = file.name;
                  preview.appendChild(fallback);
               });
         } else if (file.mime && file.mime.startsWith("image/")) {
            const img = document.createElement("img");
            img.src = fileUrl;
            img.style.maxWidth = "100%";
            img.style.borderRadius = "4px";
            preview.appendChild(img);
         } else {
            const fallback = document.createElement("p");
            fallback.textContent = file.name;
            preview.appendChild(fallback);
         }

         container.appendChild(preview);
      });
   }

   // Optional: You can attach drag & drop events here
   document
      .querySelector(".upload-card")
      .addEventListener("dragover", function (e) {
         e.preventDefault();
         this.style.borderColor = "#00aaa5";
      });

   document
      .querySelector(".upload-card")
      .addEventListener("dragleave", function (e) {
         this.style.borderColor = "#d4d4d4";
      });

   document
      .querySelector(".upload-card")
      .addEventListener("drop", function (e) {
         e.preventDefault();
         this.style.borderColor = "#d4d4d4";
         const droppedFiles = Array.from(e.dataTransfer.files);
         const event = { target: { files: droppedFiles } };
         handleImageUpload(event);
      });

   function saveToSession(file, type = "extra") {
      const formData = new FormData();
      formData.append("file", file);
      formData.append("type", type);

      fetch("/cart/uploaded-file", {
         method: "POST",
         headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
               .content,
         },
         body: formData,
      })
         .then((response) => response.json())
         .then((data) => {

            if (type === "extra" && data?.path) {
               // Find the file by name and update its path and mime
               const uploaded = uploadedFiles.find(
                  (f) => f.name === file.name && !f.path,
               );

               if (uploaded) {
                  uploaded.path = data.path;
                  uploaded.mime = data.mime; // if backend returns it
               }
               renderPreviews(); // Re-render with updated info (path, etc.)
            }

            if (type === "main") {
               // Store for later use
               renderMainPreviewFromSession({
                  name: file.name,
                  type: "main",
                  path: data.path,
                  mime: data.mime || file.type,
               });
            }
         })
         .catch((error) => {
            console.error("Error saving to session:", error);
         });
   }


  // Event listener for Dropbox button click
  document.querySelector('.btn-dropbox').addEventListener('click', function (event) {
    event.preventDefault();

    Dropbox.choose({
      // Acceptable file types/extensions
      extensions: ['.pdf', '.png', '.jpg', '.jpeg', '.doc', '.docx'],

      // Allow user to select multiple files if you want
      multiselect: false,

      // Use direct link to easily fetch each file
      linkType: "direct",

      // After user selects files
      success: function (files) {
        files.forEach(async function (file) {
          try {
            // Fetch file blob from Dropbox direct link
            const response = await fetch(file.link);
            const blob = await response.blob();

            // Determine the mime type based on the blob or extension
            let ext = file.name.split('.').pop().toLowerCase();
            let mime = blob.type !== "" ? blob.type : (
              ext === 'pdf' ? 'application/pdf' :
              ext === 'png' ? 'image/png' :
              ext === 'jpg' || ext === 'jpeg' ? 'image/jpeg' :
              ext === 'doc' ? 'application/msword' :
              ext === 'docx' ? 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' :
              'application/octet-stream'
            );

            // Create a File object from the blob to mimic local file upload
            let dropboxFile = new File([blob], file.name, { type: mime });
              renderSingleFilePreview(dropboxFile);
            saveToSession(dropboxFile, "main")
// console.log("dropboxFile",dropboxFile);

          } catch (err) {
            alert("Failed to retrieve the file from Dropbox.");
            console.error(err);
          }
        });
      }
    });
  });;

</script>
