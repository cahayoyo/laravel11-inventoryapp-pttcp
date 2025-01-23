@props(['icon', 'title', 'addButtonText' => null, 'addButtonLink' => null])

<div class="title">
    <i class="{{ $icon }}"></i>
    <span class="text">{{ $title }}</span>
</div>
@if ($addButtonText && $addButtonLink)
    <div class="add-container">
        <a href="{{ $addButtonLink }}" class="btn-add">{{ $addButtonText }}</a>
    </div>
@endif
