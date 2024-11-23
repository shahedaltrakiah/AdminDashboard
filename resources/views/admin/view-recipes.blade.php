@extends('layouts.adminNavigation')

@section('page-title', 'Manage Recipes')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">{{ $recipe->title }}</h4>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label for="viewAuthor" class="form-label">Author</label>
                    <input type="text" class="form-control" id="viewAuthor" value="{{ $recipe->user->full_name }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="viewCategory" class="form-label">Category</label>
                    <input type="text" class="form-control" id="viewCategory" value="{{ $recipe->category->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="viewTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="viewTitle" value="{{ $recipe->title }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="viewDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="viewDescription" rows="3" readonly>{{ $recipe->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="viewTime" class="form-label">Time</label>
                    <input type="text" class="form-control" id="viewTime" value="{{ $recipe->time }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="viewIngredients" class="form-label">Ingredients</label>
                    <textarea class="form-control" id="viewIngredients" rows="3" readonly>{{ $recipe->ingredients }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="viewInstructions" class="form-label">Instructions</label>
                    <textarea class="form-control" id="viewInstructions" rows="3" readonly>{{ $recipe->instructions }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="viewNutritionFacts" class="form-label">Nutrition Facts</label>
                    <textarea class="form-control" id="viewNutritionFacts" rows="3" readonly>{{ $recipe->nutrition_facts }}</textarea>
                </div>
            </div>
        </div>
    </div>

@endsection
