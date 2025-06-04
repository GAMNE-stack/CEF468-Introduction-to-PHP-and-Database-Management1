 <?php
interface Loanable {
    public function borrowBook($memberName);
    public function returnBook();
}
?>