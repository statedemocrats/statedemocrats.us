---
title: Digital Security Healthcheck
layout: page
---

A checklist for your digital health. Need more details? Check out the [Reading List](reading.html). We've
marked the things you can do with a checkbox:

* [ ] Security practices change often. Read the [history of this document](https://github.com/statedemocrats/statedemocrats.us/commits/master/.site/security/healthcheck.md).

## Passwords

* [ ] The longer the better. "Special" characters are not as important as length.
* [ ] Use a phrase of four or more unrelated words.
* [ ] If you start to enter your four words into Google.com and it autocompletes for you, those are not sufficiently random/unrelated. Use a [phrase generator](https://www.fourmilab.ch/javascrypt/pass_phrase.html).
* [ ] Use a different password for every account. Yes, it's painful, so...
* [ ] Use a password manager, like [1Password](https://1password.com/) or [LastPass](https://www.lastpass.com/).
* [ ] Don't use real answers for "security questions" (e.g. your brother's name). Knowledge-based verification can be hacked. Instead, use your password manager to create and remember random phrases.
* [ ] Don't share social media account passwords. Use your own account and delegate authorization (e.g. [Tweetdeck](https://tweetdeck.twitter.com/) or [Hootsuite](https://hootsuite.com/)).

## Multi-factor authentication

* Sometimes referred to as two-factor authentication. Abbreviated as MFA or 2FA.
* Not the same thing as [two-step authentication](https://lifehacker.com/the-difference-between-two-factor-and-two-step-authenti-1787159870). Prefer true multi-factor if you have the choice.
* Something you know, something you have, something you are. Example: ATM card (have) + PIN (know).
* Biometric = something you are. Be wary of this (fingerprints, facial recognition).
* "Something you have" can vary. In order of good, better, best:
  * [SMS](https://en.wikipedia.org/wiki/SMS) one-time password (OTP) sent to your phone (2-step)
  * [TOTP](https://en.wikipedia.org/wiki/Time-based_One-time_Password_Algorithm) (time-based one-time password) app (2-factor)
  * Paper list of one-time recovery codes. (2-factor)
  * [U2F](https://en.wikipedia.org/wiki/Universal_2nd_Factor) Universal 2nd Factor, hardware security key (2-factor)
* [ ] Set it up everywhere it is offered: Facebook, Google, Twitter, Slack, NGP/VAN (ActionID), your bank - see [comprehensive list](https://twofactorauth.org/).
* [ ] Print out a sheet of backup recovery codes and keep that paper in a safe place. Treat it like your birth certificate or your car title.
* [ ] If your email account does not offer 2FA, change your email provider. Really.

## Phones

* [ ] Run all software updates.
* [ ] Use a PIN of at least 6 characters to secure your phone. If your phone offers biometric (fingerprint) unlock, consider using a longer complex passcode (8+ characters) and the biometric for convenience.
* [ ] Autolock the screen in 2 minutes (or less) of inactivity.
* [ ] Install a 2FA TOTP app: [Duo](https://duo.com/), [Google Authenticator](https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en), or [Authy](https://www.authy.com/)
* [ ] Set up a customer account passcode with your mobile phone company. This helps them verify you when you speak with them or log in to your account online.

## Computers

* [ ] Run all software updates.
* [ ] Turn on full-disk encryption.
  * For Macs, this is System Preferences &#187; Security & Privacy &#187; FileVault.
  * For Windows, it's more complicated, but [here is an article describing options](https://www.howtogeek.com/234826/how-to-enable-full-disk-encryption-on-windows-10/).
* [ ] Make sure your screen locks when it sleeps or after two minutes (or less) of inactivity.
* [ ] Use an account password at least 10 characters long. Best is four or more unrelated words.

## Privacy

* [ ] Do not send sensitive information via unencrypted email.
* [ ] [Always use HTTPS](https://en.wikipedia.org/wiki/HTTPS_Everywhere).
* [ ] Use a [end-to-end encrypted service](https://en.wikipedia.org/wiki/End-to-end_encryption) to send sensitive information. Examples include [Keybase](https://keybase.io/), [WhatsApp](https://www.whatsapp.com/) and [Signal](https://signal.org/).
* [ ] Treat constituent data as if it were your own. Shred VAN paper printouts after data entry. Store paper in a safe place.

## [Phishing](https://en.wikipedia.org/wiki/Phishing)

* [ ] Getting a fraudelent email does *not* mean an account has been hacked.
* [ ] MFA/2FA and password manager are really important preventions.
* [ ] Be alert. If an email looks a little "off" pick up the phone and verify the sender. Do *not* reply to the email or click on any links. Verify it out of band (verbally or text message) to trust the sender.
* [ ] Follow your [incident response plan](https://www.belfercenter.org/CyberPlaybook#step4). Don't have any? Time to write one.
* [ ] If you use Gmail, you can report an email as Phishing using the same menu you use to Reply or Forward.

## Incident Response Plan

* Bad things happen. It's not usually your fault.
* [ ] [Plan ahead](https://www.belfercenter.org/CyberPlaybook#step4) for how you'll respond when bad things happen.
* [ ] Document your plan.
* [ ] Practice your plan. See for example [Cofense (formerly PhishMe)](https://cofense.com/) and [KnowBe4](https://www.knowbe4.com/).

