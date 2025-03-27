*/
     public function up(): void
     {
         Schema::create('product', function (Blueprint $table) {
         Schema::create('products', function (Blueprint $table) {
             $table->id();
             $table->string('name');
             $table->bigInteger('category_id')->unsigned();
             $table->double('pricing');
             $table->text('description')->nullable();
             $table->jsonb('images')->nullable();
             $table->timestamps();
             $table->foreign('category_id')->references('id')->on('categories');
         });
     }

     /**php
      * Reverse the migrations.
      */
     public function down(): void
     {
         Schema::dropIfExists('product');
     }
 };
