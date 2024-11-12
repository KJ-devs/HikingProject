// import NavBar from "../components/navbar/Navbar";
import SignUpForm from "../features/authentication/components/SignUpForm/SignUpForm";
import { MantineProvider } from "@mantine/core";

function SignUp() {
  return (
    <>
      <MantineProvider>
        <div>
          <SignUpForm />
        </div>
      </MantineProvider>
    </>
  );
}

export default SignUp;
