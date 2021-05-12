/*	pets.cpp

	A class petID is used to identify
	pets based on sounds, using the pets.xpl compiled Prolog
	program.

	Error handling is done using the C++ catch/throw mechanism.
	To try it, simply rename pets.xpl to something else, and
	watch for the error generated by a missing Prolog load module.

	This example includes an implementation of an extended predicate,
	used by the Prolog program to prompt the user for information.
	The predicate is defined using AddPred, which now takes a third
	argument.  That third argument can be any pointer you like, and
	it will be passed to the global function, defined in the second
	argument.

	In this example, the third argument to AddPred is the 'this' pointer,
	so it gets passed to ::p_prompt when its called.  ::p_prompt then
	uses that argument to dispatch the function to appropriate
	instance of class petID.

	*/

#include <iostream>
//#include <stdio>
#include <string>
#include "logicserver.h"

using namespace std;

// Create a class which provides a service to the application
// that uses a Logic Server and a Prolog logic base.

class petID
{
private:
	LogicServer ls;
public:
   petID();
	~petID();
	TF p_prompt();  // The class implementation of the extended predicate
	string GetPet();
};

int main()
{
	// Catch Logic Server errors.
	try
	{
		petID p1;
		string buf;

		buf = p1.GetPet();
		cout << "pet is a " << buf << '\n';
	}
#ifdef GNU
	// A bug causes segmentation faults when CLSException
	// objects are thrown in Gnu C++, so pointers to the
	// object are thrown instead when working with Gnu.
   // See amzi.h for details.
	catch(LSException *e)
	{
		string errmsg;
		errmsg = e->GetMsg();
		cout << "Logic Server Exception " << e->GetRC()
			<< ": " << errmsg << '\n';
		return -1;
	}
#else
	catch(LSException &e)
	{
		string errmsg;
		errmsg = e.GetMsg();
		cout << "Logic Server Exception " << e.GetRC()
			<< ": " << errmsg << '\n';
		return -1;
	}
#endif
}

TF EXPFUNC p_prompt(VOIDptr p)
// The global dispatch function.  This is the function address passed
// to the Logic Server as the function to call when the Prolog predicate,
// prompt/2, is called.  When the function address is passed to the
// Prolog engine during initialization, a pointer is also passed, which
// is used as an argument.  In this case, that pointer was the 'this'
// pointer, so this dispatch function can then call the correct instance
// of petID to carry out the function.
{
	return ((petID*)p)->p_prompt();
}

petID::petID()
{
	// This try/catch is designed to catch Logic Server exceptions
	// and deal with them in the member function error.  Note it
	// catches a reference to the exception object that is thrown
	// by the Logic Server.

	// Use Init2 rather than Init in order to set the
	// .ini parameters from an argument instead of a
	// .ini file.  In this case, the heap, local, control
	// and trail are set to small numbers because we have
	// a small program.

	ls.Init2("h=100, l=100, c=200, t=100");

	// Tell the engine prompt/2 is implemented by
	// calling the global dispatch function, p_prompt,
	// with the argument 'this', used to get control
	// back in this instance of petID.

	ls.AddPred("prompt", 2, &::p_prompt, this);
	ls.Load("pets");
}

petID::~petID()
{
   ls.Close();
}

TF petID::p_prompt()
{
	string answer;
	string prompt;

	prompt = ls.GetStrParm(1);

	cout << prompt << "> ";
	cin >> answer;

	return ls.UnifyAtomParm(2, answer);
}

string petID::GetPet()
{
	TERM t;
   string pet;

	if ( t = ls.ExecStr("pet(X)") )
		pet = ls.GetStrArg(t, 1);
	else
      pet = "unknown";
   return pet;
}
