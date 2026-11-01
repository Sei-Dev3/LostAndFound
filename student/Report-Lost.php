<div class="title-heading">
    <h1>Report Lost Item</h1>
    <p>Report an item you have lost. Please provide the details below.</p>
</div>

<div class="fillout">
    <div class="fillout-container">

        <!-- Lost and Found Navigation -->
        <div class="item-btn">
            <button type="button" class="lost-button active">
                <i class="fa-solid fa-bag-shopping"></i>
                Lost Item
            </button>

            <a href="Report-Found.php" class="found-button">
                <i class="fa-solid fa-magnifying-glass"></i>
                Found Item
            </a>
        </div>

        <!-- Report Lost Form -->
        <form class="lost-form">

            <div class="form-section-heading">
                <h2>Item Information</h2>
                <p>Fields marked with * are required.</p>
            </div>

            <div class="form-grid">

                <div class="label-input">
                    <label for="item-name">Item Name *</label>
                    <input
                        type="text"
                        id="item-name"
                        name="item_name"
                        placeholder="e.g. Black wallet, iPhone 13, Backpack"
                        required
                    >
                </div>

                <div class="label-input">
                    <label for="category">Category *</label>
                    <select id="category" name="category" required>
                        <option value="" disabled selected>
                            Select Category
                        </option>
                        <option value="bags">Bags</option>
                        <option value="electronics">Electronics</option>
                        <option value="wallets">Wallets</option>
                        <option value="keys">Keys</option>
                        <option value="clothing">Clothing</option>
                        <option value="others">Others</option>
                    </select>
                </div>

                <div class="label-input">
                    <label for="location">Location Lost *</label>
                    <select id="location" name="location" required>
                        <option value="" disabled selected>
                            Select Location
                        </option>
                        <option value="library">Library</option>
                        <option value="canteen">Canteen</option>
                        <option value="classroom">Classroom</option>
                        <option value="gymnasium">Gymnasium</option>
                        <option value="school-gate">School Gate</option>
                        <option value="others">Others</option>
                    </select>
                </div>

                <div class="label-input">
                    <label for="date-lost">Date Lost *</label>
                    <input
                        type="date"
                        id="date-lost"
                        name="date_lost"
                        required
                    >
                </div>

                <div class="label-input full-width">
                    <label for="description">Description *</label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Describe your item. Include its color, brand, unique features, or other identifying details."
                        rows="5"
                        required
                    ></textarea>
                </div>

                <div class="label-input full-width">
                    <label for="item-photo">Item Photo</label>

                    <label for="item-photo" class="upload-container">
                        <i class="fa-solid fa-cloud-arrow-up"></i>

                        <p>Click to upload your item photo</p>

                        <span>PNG, JPG or JPEG (Max 5MB)</span>
                    </label>

                    <input
                        type="file"
                        id="item-photo"
                        name="item_photo"
                        accept="image/png, image/jpeg"
                        hidden
                    >
                </div>

            </div>

            <div class="form-footer">
                <button type="reset" class="cancel">
                    Cancel
                </button>

                <button type="button" class="submit">
                    <i class="fa-solid fa-paper-plane"></i>
                    Submit Report
                </button>
            </div>

        </form>
    </div>
</div>