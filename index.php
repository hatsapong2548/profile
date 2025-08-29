<?php
/* ===========================
   BASIC SETTINGS — EDIT HERE
   =========================== */
$owner = [
  "name" => "Your Name",
  "title" => "Full-Stack Developer",
  "about" => "ผมเป็นนักพัฒนาที่ชอบเว็บแอป ความเร็วเรียบง่าย และงานที่ดูสะอาดตา โฟกัสที่ PHP + JS + Tailwind",
  "email" => "you@example.com",
  "location" => "Thailand",
  "social" => [
    ["label"=>"GitHub", "url"=>"https://github.com/yourid"],
    ["label"=>"LinkedIn", "url"=>"https://www.linkedin.com/in/yourid/"],
    ["label"=>"X (Twitter)", "url"=>"https://x.com/yourid"]
  ]
];

$skills = ["PHP","Laravel","MySQL","JavaScript","Node.js","React","Tailwind CSS","REST API","Git","Docker"];

/* Projects data — เพิ่ม/แก้ได้ตามต้องการ */
$projects = [
  [
    "title"=>"Portfolio Minimal",
    "desc"=>"เว็บพอร์ตโฟลิโอเรียบง่าย โหลดไว ใช้ Tailwind + PHP",
    "tags"=>["PHP","Tailwind"],
    "link"=>"#",
    "repo"=>"#"
  ],
  [
    "title"=>"Library CRUD",
    "desc"=>"ระบบจัดการหนังสือ CRUD ด้วย PHP + MySQL",
    "tags"=>["PHP","MySQL","CRUD"],
    "link"=>"#",
    "repo"=>"#"
  ],
  [
    "title"=>"API Wrapper",
    "desc"=>"ตัวอย่าง PHP เรียกใช้งาน 3rd-party API + แคชผลลัพธ์",
    "tags"=>["PHP","API","Caching"],
    "link"=>"#",
    "repo"=>"#"
  ],
];

/* ===========================
   CONTACT FORM HANDLER
   =========================== */
$flash = null;
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["contact_form"])) {
  // ป้องกัน XSS เบื้องต้น
  $name  = trim(strip_tags($_POST["name"] ?? ""));
  $email = trim(strip_tags($_POST["email"] ?? ""));
  $msg   = trim(strip_tags($_POST["message"] ?? ""));

  $errors = [];
  if ($name === "")  $errors[] = "กรุณากรอกชื่อ";
  if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "อีเมลไม่ถูกต้อง";
  if ($msg === "")   $errors[] = "กรุณากรอกข้อความ";

  if (empty($errors)) {
    // ตัวอย่าง: ส่งอีเมล ( uncomment ถ้าตั้งค่าเซิร์ฟเวอร์ส่งเมลไว้แล้ว )
    /*
    $to      = $owner["email"];
    $subject = "New message from Portfolio";
    $content = "Name: $name\nEmail: $email\n\nMessage:\n$msg\n";
    @mail($to, $subject, $content, "From: $email");
    */

    // หรือจะบันทึกลงไฟล์ (บนโฮสติ้งบางที่ไฟล์อาจไม่ถาวร)
    // @file_put_contents(__DIR__."/contact.log", date("c")." | $name <$email> : $msg\n", FILE_APPEND);

    $flash = ["type"=>"success","text"=>"ส่งข้อความเรียบร้อย ขอบคุณครับ!"];
  } else {
    $flash = ["type"=>"error","text"=>implode(" • ", $errors)];
  }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($owner["name"]) ?> — Portfolio</title>
  <meta name="description" content="Portfolio ของ <?= htmlspecialchars($owner['name']) ?> | <?= htmlspecialchars($owner['title']) ?>">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-neutral-950 text-neutral-100">
  <!-- NAV -->
  <header class="sticky top-0 z-50 backdrop-blur supports-[backdrop-filter]:bg-neutral-950/70">
    <div class="max-w-6xl mx-auto px-5 py-4 flex items-center justify-between">
      <a href="#home" class="font-semibold tracking-wide"><?= htmlspecialchars($owner["name"]) ?></a>
      <nav class="space-x-4 text-sm">
        <a href="#about" class="hover:underline">About</a>
        <a href="#skills" class="hover:underline">Skills</a>
        <a href="#projects" class="hover:underline">Projects</a>
        <a href="#contact" class="hover:underline">Contact</a>
      </nav>
    </div>
  </header>

  <!-- HERO -->
  <section id="home" class="max-w-6xl mx-auto px-5 py-20">
    <div class="grid md:grid-cols-2 gap-10 items-center">
      <div>
        <h1 class="text-4xl md:text-5xl font-bold leading-tight">
          สวัสดี, ผมคือ <span class="text-indigo-400"><?= htmlspecialchars($owner["name"]) ?></span>
        </h1>
        <p class="mt-4 text-lg text-neutral-300"><?= htmlspecialchars($owner["title"]) ?> • <?= htmlspecialchars($owner["location"]) ?></p>
        <p class="mt-6 text-neutral-300"><?= htmlspecialchars($owner["about"]) ?></p>
        <div class="mt-6 flex flex-wrap gap-3">
          <?php foreach ($owner["social"] as $s): ?>
            <a href="<?= htmlspecialchars($s["url"]) ?>" class="px-4 py-2 rounded-xl bg-neutral-800 hover:bg-neutral-700 transition">
              <?= htmlspecialchars($s["label"]) ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="md:justify-self-end">
        <!-- Placeholder avatar -->
        <div class="w-56 h-56 md:w-64 md:h-64 rounded-3xl bg-gradient-to-br from-indigo-500 via-sky-500 to-cyan-400"></div>
      </div>
    </div>
  </section>

  <!-- SKILLS -->
  <section id="skills" class="max-w-6xl mx-auto px-5 py-12">
    <h2 class="text-2xl font-semibold mb-6">Skills</h2>
    <div class="flex flex-wrap gap-3">
      <?php foreach ($skills as $skill): ?>
        <span class="px-3 py-1 rounded-full bg-neutral-800 text-sm"><?= htmlspecialchars($skill) ?></span>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROJECTS -->
  <section id="projects" class="max-w-6xl mx-auto px-5 py-12">
    <h2 class="text-2xl font-semibold mb-6">Projects</h2>
    <div class="grid md:grid-cols-3 gap-6">
      <?php foreach ($projects as $p): ?>
        <article class="p-5 rounded-2xl bg-neutral-900 border border-neutral-800">
          <h3 class="text-lg font-semibold"><?= htmlspecialchars($p["title"]) ?></h3>
          <p class="mt-2 text-neutral-300"><?= htmlspecialchars($p["desc"]) ?></p>
          <div class="mt-3 flex flex-wrap gap-2">
            <?php foreach ($p["tags"] as $t): ?>
              <span class="px-2 py-0.5 rounded-md bg-neutral-800 text-xs"><?= htmlspecialchars($t) ?></span>
            <?php endforeach; ?>
          </div>
          <div class="mt-4 flex gap-3">
            <a href="<?= htmlspecialchars($p["link"]) ?>" class="text-sm underline underline-offset-4">Demo</a>
            <a href="<?= htmlspecialchars($p["repo"]) ?>" class="text-sm underline underline-offset-4">Repo</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact" class="max-w-6xl mx-auto px-5 py-16">
    <h2 class="text-2xl font-semibold mb-6">Contact</h2>

    <?php if ($flash): ?>
      <div class="mb-6 p-4 rounded-xl <?= $flash["type"]==='success'?'bg-emerald-900/30 text-emerald-300 border border-emerald-700':'bg-rose-900/30 text-rose-300 border border-rose-700' ?>">
        <?= htmlspecialchars($flash["text"]) ?>
      </div>
    <?php endif; ?>

    <form method="post" class="grid md:grid-cols-2 gap-4">
      <input type="hidden" name="contact_form" value="1">
      <div class="md:col-span-1">
        <label class="block text-sm mb-1">ชื่อ</label>
        <input name="name" class="w-full px-3 py-2 rounded-xl bg-neutral-900 border border-neutral-800 focus:outline-none" required>
      </div>
      <div class="md:col-span-1">
        <label class="block text-sm mb-1">อีเมล</label>
        <input name="email" type="email" class="w-full px-3 py-2 rounded-xl bg-neutral-900 border border-neutral-800 focus:outline-none" required>
      </div>
      <div class="md:col-span-2">
        <label class="block text-sm mb-1">ข้อความ</label>
        <textarea name="message" rows="5" class="w-full px-3 py-2 rounded-xl bg-neutral-900 border border-neutral-800 focus:outline-none" required></textarea>
      </div>
      <div class="md:col-span-2">
        <button class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 transition">ส่งข้อความ</button>
      </div>
    </form>
    <p class="mt-4 text-sm text-neutral-400">หรืออีเมล: <a class="underline" href="mailto:<?= htmlspecialchars($owner['email']) ?>"><?= htmlspecialchars($owner['email']) ?></a></p>
  </section>

  <footer class="py-10 text-center text-neutral-500">
    © <?= date("Y") ?> <?= htmlspecialchars($owner["name"]) ?> — Built with PHP + Tailwind
  </footer>
</body>
</html>
