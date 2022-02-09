#include <unistd.h>
#include <stdlib.h>

int main() {
    setuid(1000);
    system("touch /tmp/hello_world");
    return 0; 
}
