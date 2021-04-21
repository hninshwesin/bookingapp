<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>

    <a href="{{ route('doctor.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-user"></i>
        <p>Doctor List</p>
    </a>

    <a href="{{ route('patient.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-user-alt"></i>
        <p>Patient List</p>
    </a>

    <a href="{{ route('specialization.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-stethoscope"></i>
        <p>Specialization List</p>
    </a>
    <a href="{{ route('doctor_approve') }}" class="nav-link active">
        <i class="nav-icon fas fa-stethoscope"></i>
        <p>Approve Doctor</p>
    </a>
</li>
